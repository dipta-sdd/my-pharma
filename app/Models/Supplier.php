<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact_info', 'terms_of_agreement', 'created_by', 'updated_by'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function supplies()
    {
        return $this->hasMany(Supply::class);
    }
}
