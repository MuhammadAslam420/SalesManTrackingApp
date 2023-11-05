<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Spatie\QueryBuilder\QueryBuilder;


class Salesman extends Model implements Authenticatable
{
    use AuthenticableTrait;
    use HasFactory, Notifiable;
    use Sortable;


    protected $table = 'salesmen';

    protected $fillable = [
        'name',
        'username',
        'employee_no',
        'email',
        'mobile',
        'password',
        'status',
        'online',
        'avatar',
        'city',
        'address',
        'lng',
        'lat',
        'created_by',
        'deleted_at',
    ];

	public $sortable = ['id','name', 'username', 'employee_no','email','mobile','status','online','city', 'created_at'];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public static function search($keyword)
    {
        return QueryBuilder::for(Salesman::class)
        ->where('name', 'like', "%$keyword%")
        ->orWhere('username', 'like', "%$keyword%")
        ->orWhere('employee_no', 'like', "%$keyword%")
        ->orWhere('email', 'like', "%$keyword%")
        ->orWhere('mobile', 'like', "%$keyword%")
        ->orWhere('status', 'like', "%$keyword%")
        ->orWhere('online', 'like', "%$keyword%")
        ->orWhere('city', 'like', "%$keyword%");
    }

    public function pay()
    {
        return $this->hasOne(Pay::class);
    }



    public function routes()
    {
        return $this->hasMany(Route::class);
    }

    public function visits()
    {
        return $this->hasMany(TodayVisit::class);
    }

    public function routeHistory()
    {
        return $this->hasMany(RouteHistory::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
