<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "categories";
    protected $fillable = ['name', 'slug', 'logo', 'status'];

    public function scopeSearch($query,$keyword)
    {
        return $query->where('id','like',"%$keyword%")
        ->orWhere('name','like',"%$keyword%")
        ->orWhere('slug','like',"%$keyword%")
        ->orWhere('status','like',"%$keyword%")
        ->orWhere('created_at','like',"%$keyword%");
    }
    public function subcategories()
{
    return $this->hasMany(SubCategory::class);
}

}
