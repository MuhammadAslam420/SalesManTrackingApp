<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $table = "transactions";
    protected $fillable = [
        'order_id',
        'total',
        'payment_status',
        'payment_mode',
        'customer_id',
    ];

    public function scopeSearch($query, $keyword)
    {
      return $query->where('id','like',"%$keyword%")
      ->orWhere('order_id','like',"%$keyword%")
      ->orWhere('total','like',"%$keyword%")
      ->orWhere('status','like',"%$keyword%")
      ->orWhere('payment_mode','like',"%$keyword%")
      ->orWhere('created_at','like',"%$keyword%");
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
