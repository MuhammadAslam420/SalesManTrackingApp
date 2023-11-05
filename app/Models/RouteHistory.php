<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RouteHistory extends Model
{
    use HasFactory;
    protected $table = "route_histories";
    protected $fillable = [
        'salesman_id',
        'lng',
        'lat',
    ];

    public function salesman()
    {
        return $this->belongsTo(Salesman::class);
    }
}
