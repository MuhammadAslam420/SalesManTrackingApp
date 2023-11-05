<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\QueryBuilder\QueryBuilder;

class Route extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = "routes";
    protected $fillable = [
        'name',
        'salesman_id',
        'assigned_by_id',
        'status',
        'visit_day',
    ];
    public $sortable = ['id','name','salesman_id','assigned_by_id','status','visit_day','created_at'];

    public static function search($keyword)
    {
       return QueryBuilder::for(Route::class)
       ->where('id','like',"%$keyword%")
       ->orWhere('name','like',"%$keyword%")
       ->orWhere('salesman_id','like',"%$keyword%")
       ->orWhere('assigned_by_id','like',"%$keyword%")
       ->orWhere('status','like',"%$keyword%")
       ->orWhere('visit_day','like',"%$keyword%")
       ->orWhere('created_at','like',"%$keyword%");
    }
    public function salesman()
    {
        return $this->belongsTo(Salesman::class);
    }

    public function assignedBy()
    {
        return $this->belongsTo(Admin::class, 'assigned_by_id');
    }
    public function routeCustomer()
    {
        return $this->hasOne(RouteCustomer::class);
    }
}
