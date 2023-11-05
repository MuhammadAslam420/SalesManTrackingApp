<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\QueryBuilder\QueryBuilder;

class Admin extends Model implements Authenticatable
{
    use AuthenticableTrait;
    use HasFactory, Notifiable;

    protected $table = "admins";

    protected $fillable = [
        'name',
        'email',
        'mobile',
        'avatar',
        'status',
        'email_verified_at',
        'password',
        'deleted_at',
    ];
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
        return QueryBuilder::for(Admin::class)->where('name', 'like', "%$keyword%")
            ->orWhere('email', 'like', "%$keyword%")
            ->orWhere('mobile', 'like', "%$keyword%")
            ->orWhere('status', 'like', "%$keyword%")
            ->orWhere('created_at', 'like', "%$keyword%");
    }

}
