<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'supplier_id', 'generic_name_id', 'type', 'created_by', 'updated_by'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function genericName()
    {
        return $this->belongsTo(GenericName::class);
    }

    public function productStrengths()
    {
        return $this->hasMany(ProductStrength::class);
    }
}
