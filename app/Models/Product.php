<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\QueryBuilder\QueryBuilder;

class Product extends Model
{
    use HasFactory;

    protected $table = "products";
    protected $fillable = ['name','slug', 'description', 'stockIn', 'qty', 'sale_qty',
    'image', 'SKU', 'status', 'purchase_cost', 'sale_cost', 'discount_percentage',
     'discount_on_qty', 'discount_date_start', 'discount_date_end', 'sub_category_id'];



    public static function search($keyword)
    {
        return QueryBuilder::for(Product::class)
        ->where('name','like',"%$keyword%")
        ->orWhere('id','like',"%$keyword%")
        ->orWhere('SKU','like',"%$keyword%")
        ->orWhere('status','like',"%$keyword%")
        ->orWhere('discount_date_start','like',"%$keyword%")
        ->orWhere('discount_date_end','like',"%$keyword%")
        ->orWhere('created_at','like',"%$keyword%");
    }

    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'sub_category_id');
    }
}
