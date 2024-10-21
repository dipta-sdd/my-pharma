<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_strength_id',
        'supply_id',
        'batch_number',
        'quantity',
        'supplied_quantity',
        'buying_price',
        'selling_price',
        'expiration_date',
        'branch_id',
        'created_by',
    ];

    public function productStrength()
    {
        return $this->belongsTo(ProductStrength::class);
    }

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function productReturns()
    {
        return $this->hasMany(ProductReturns::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
