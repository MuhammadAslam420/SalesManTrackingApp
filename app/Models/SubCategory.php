<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = "sub_categories";
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'status',
        'category_id',
    ];

    public function scopeSearch($query,$keyword)
    {
        return $query->where('id','like',"%$keyword%")
        ->orWhere('category_id','like',"%$keyword%")
        ->orWhere('name','like',"%$keyword%")
        ->orWhere('status','like',"%$keyword%")
        ->orWhere('created_at','like',"%$keyword%");
    }

    public function category()
{
    return $this->belongsTo(Category::class);
}
public function products()
{
    return $this->hasMany(Product::class);
}

}
