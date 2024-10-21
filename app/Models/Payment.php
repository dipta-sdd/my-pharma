<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['supply_id', 'amount', 'payment_method', 'payment_date', 'branch_id', 'created_by'];

    public function supply()
    {
        return $this->belongsTo(Supply::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
