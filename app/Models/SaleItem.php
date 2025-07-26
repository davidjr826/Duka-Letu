<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'price',
        'total_price'
    ];

    protected $casts = [
        'quantity' => 'integer',
        'price' => 'decimal:2',
        'total_price' => 'decimal:2',
    ];

    // Relationships
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class)->withTrashed();
    }

    // Accessors
    // public function getProfitAttribute()
    // {
    //     return ($this->price - $this->product->cost_price) * $this->quantity;
    // }

    // In SaleItem.php model
public function getProfitAttribute()
{
    // Ensure all required values exist
    if (!$this->product || !isset($this->product->cost_price) || 
        !isset($this->price) || !isset($this->quantity)) {
        return 0;
    }
    
    // Calculate profit per item
    $unitProfit = $this->price - $this->product->cost_price;
    
    // Return total profit for this line item
    return $unitProfit * $this->quantity;
}

// Also add this to your $appends array to make it available in JSON
protected $appends = ['profit'];

}