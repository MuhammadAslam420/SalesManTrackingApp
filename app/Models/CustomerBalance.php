<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerBalance extends Model
{
    use HasFactory;

    protected $table = "customer_balances";
    protected $fillable = [
        'customer_id',
        'order_id',
        'total',
        'paid',
        'remaining',
    ];
    public function scopeSearch($query, $keyword)
    {
        return $query->where('order_id', 'like', "%$keyword%")
            ->orWhere('total', 'like', "%$keyword%")
            ->orWhere('paid', 'like', "%$keyword%")
            ->orWhere('remaining', 'like', "%$keyword%")
            ->orWhere('created_at', 'like', "%$keyword%");
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
