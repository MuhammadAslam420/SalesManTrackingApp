<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = [
        'customer_id',
        'delivery_date',
        'status',
        'total',
        'tax',
        'subtotal',
        'discount',

        'sale_man_id',
        'salesman_commission'
    ];
    public function scopeSearch($query, $keyword)
    {
        return $query->where('id', 'like', "%$keyword%")
            ->orWhere('total', 'like', "%$keyword%")
            ->orWhere('tax', 'like', "%$keyword%")
            ->orWhere('discount', 'like', "%$keyword%")
            ->orWhere('subtotal', 'like', "%$keyword%")
            ->orWhere('status', 'like', "%$keyword%")
            ->orWhere('delivery_date', 'like', "%$keyword%")
            ->orWhere('salesman_id', 'like', "%$keyword%")
            ->orWhere('created_at', 'like', "%$keyword%");
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function salesman()
    {
        return $this->belongsTo(Salesman::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function customerBalance()
    {
        return $this->hasOne(CustomerBalance::class);
    }
}
