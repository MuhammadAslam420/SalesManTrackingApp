<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
    use HasFactory;

    protected $table="pays";

    protected $fillable = [
        'salesman_id',
        'basic',
        'medical',
        'transport',
        'annual_bonus',
        'annual_increment',
        'commission_on_sales'
    ];

    public function salesman()
    {
        return $this->belongsTo(Salesmen::class);
    }
}
