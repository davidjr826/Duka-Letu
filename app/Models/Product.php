<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Events\LowStockAlert;
use App\Events\OutOfStockAlert;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    // Status Constants
    const STATUS_ACTIVE = 'active';
    const STATUS_LOW_STOCK = 'low_stock';
    const STATUS_OUT_OF_STOCK = 'out_of_stock';
    const STATUS_DISCONTINUED = 'discontinued';

    protected $fillable = [
        'name',
        'barcode',
        'description',
        'price',
        'cost_price',
        'quantity',
        'unit',
        'category_id',
        'supplier_id',
        'image',
        'reorder_level',
        'status' // Added status field
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'quantity' => 'integer',
        'reorder_level' => 'integer',
        'deleted_at' => 'datetime',
    ];

    protected $dates = ['deleted_at'];

    protected $dispatchesEvents = [
        'updated' => \App\Events\ProductStockUpdated::class,
    ];

    // Relationships (unchanged)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    // Accessors
    public function getProfitAttribute()
    {
        return $this->price - $this->cost_price;
    }

    public function getProfitMarginAttribute()
    {
        if ($this->cost_price == 0) return 0;
        return (($this->price - $this->cost_price) / $this->cost_price) * 100;
    }

    public function getStockStatusAttribute()
    {
        if ($this->status === self::STATUS_DISCONTINUED) {
            return self::STATUS_DISCONTINUED;
        }

        if ($this->quantity <= 0) {
            return self::STATUS_OUT_OF_STOCK;
        }

        if ($this->quantity <= $this->reorder_level) {
            return self::STATUS_LOW_STOCK;
        }

        return self::STATUS_ACTIVE;
    }

    public function getIsLowStockAttribute()
    {
        return $this->stock_status === self::STATUS_LOW_STOCK;
    }

    // Scopes
    public function scopeLowStock($query)
    {
        return $query->where('quantity', '<=', \DB::raw('reorder_level'))
                    ->where('quantity', '>', 0)
                    ->where('status', '!=', self::STATUS_DISCONTINUED);
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('quantity', '<=', 0)
                    ->where('status', '!=', self::STATUS_DISCONTINUED);
    }

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeSearch($query, $term)
    {
        return $query->where('name', 'like', "%{$term}%")
                    ->orWhere('barcode', 'like', "%{$term}%");
    }

    // Automatic status management
    protected static function booted()
    {
        static::updated(function ($product) {
            $originalQuantity = $product->getOriginal('quantity');
            $currentQuantity = $product->quantity;
            
            // Only check if quantity changed
            if ($originalQuantity != $currentQuantity) {
                $product->updateStockStatus();
            }
        });
    }

    public function updateStockStatus()
    {
        $newStatus = $this->stock_status;
        
        if ($this->status !== $newStatus) {
            $this->status = $newStatus;
            $this->saveQuietly(); // Prevent recursion
            
            // Dispatch appropriate events
            if ($newStatus === self::STATUS_LOW_STOCK) {
                event(new LowStockAlert($this));
            } elseif ($newStatus === self::STATUS_OUT_OF_STOCK) {
                event(new OutOfStockAlert($this));
            }
        }
    }

    // Business methods
    public function markAsDiscontinued()
    {
        $this->status = self::STATUS_DISCONTINUED;
        $this->save();
        return $this;
    }

    public function restock($quantity)
    {
        $this->quantity += $quantity;
        $this->save(); // Will trigger status update automatically
        return $this;
    }
}