<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStrength extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'strength', 'base_buying_price', 'base_selling_price', 'created_by', 'updated_by'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }
}
