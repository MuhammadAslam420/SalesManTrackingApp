<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodayVisit extends Model
{
    use HasFactory;
    protected $table = "today_visits";
    protected $fillable = [
        'salesman_id',
        'customer_id',
    ];

    public function salesman()
    {
        return $this->belongsTo(Salesman::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
