<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'inventory';

    /**
     * Movement types constants
     */
    const MOVEMENT_TYPE_PURCHASE = 'purchase';
    const MOVEMENT_TYPE_SALE = 'sale';
    const MOVEMENT_TYPE_ADJUSTMENT = 'adjustment';
    const MOVEMENT_TYPE_RETURN = 'return';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'quantity',
        'unit_cost',
        'movement_type',
        'user_id',
        'notes'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'quantity' => 'integer',
        'unit_cost' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Relationships
     */
    
    /**
     * Get the product associated with the inventory record.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user who created the inventory record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scopes
     */
    
    /**
     * Scope a query to only include purchase movements.
     */
    public function scopePurchases($query)
    {
        return $query->where('movement_type', self::MOVEMENT_TYPE_PURCHASE);
    }

    /**
     * Scope a query to only include sale movements.
     */
    public function scopeSales($query)
    {
        return $query->where('movement_type', self::MOVEMENT_TYPE_SALE);
    }

    /**
     * Scope a query to only include adjustment movements.
     */
    public function scopeAdjustments($query)
    {
        return $query->where('movement_type', self::MOVEMENT_TYPE_ADJUSTMENT);
    }

    /**
     * Scope a query to only include return movements.
     */
    public function scopeReturns($query)
    {
        return $query->where('movement_type', self::MOVEMENT_TYPE_RETURN);
    }

    /**
     * Scope a query to only include recent records.
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }

    /**
     * Accessors & Mutators
     */
    
    /**
     * Get the total cost of the inventory movement.
     *
     * @return float
     */
    public function getTotalCostAttribute()
    {
        return $this->quantity * $this->unit_cost;
    }

    /**
     * Get the human-readable movement type label.
     *
     * @return string
     */
    public function getMovementTypeLabelAttribute()
    {
        return match($this->movement_type) {
            self::MOVEMENT_TYPE_PURCHASE => 'Purchase',
            self::MOVEMENT_TYPE_SALE => 'Sale',
            self::MOVEMENT_TYPE_ADJUSTMENT => 'Adjustment',
            self::MOVEMENT_TYPE_RETURN => 'Return',
            default => ucfirst($this->movement_type)
        };
    }

    /**
     * Business Logic
     */
    
    /**
     * Record a new inventory movement.
     *
     * @param int $productId
     * @param int $quantity
     * @param float $unitCost
     * @param string $movementType
     * @param int $userId
     * @param string|null $notes
     * @return Inventory
     */
    public static function recordMovement(
        int $productId,
        int $quantity,
        float $unitCost,
        string $movementType,
        int $userId,
        string $notes = null
    ): Inventory {
        return self::create([
            'product_id' => $productId,
            'quantity' => $quantity,
            'unit_cost' => $unitCost,
            'movement_type' => $movementType,
            'user_id' => $userId,
            'notes' => $notes
        ]);
    }
}