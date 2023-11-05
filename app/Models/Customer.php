<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Spatie\QueryBuilder\QueryBuilder;

class Customer extends Model implements Authenticatable
{
    use AuthenticableTrait;
    use HasFactory, Notifiable;
    protected $table = "customers";
    protected $fillable = [
        'username',
        'shopname',
        'email',
        'mobile',
        'city',
        'address',
        'lng',
        'lat',
        'avatar',
        'status',
        'password',
        'created_by',
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
        return QueryBuilder::for (Customer::class)
                ->where('id', 'like', "%$keyword%")
                ->orWhere('username', 'like', "%$keyword%")
                ->orWhere('shopname', 'like', "$keyword%")
                ->orWhere('email', 'like', "%$keyword%")
                ->orWhere('mobile', 'like', "%$keyword%")
                ->orWhere('city', 'like', "%$keyword%")
                ->orWhere('status', 'like', "%$keyword%")
                ->orWhere('address', 'like', "%$keyword%");
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function getLastTransactionsAttribute()
    {
        $lastTransaction = $this->transactions()->latest('created_at')->first();

        return $lastTransaction ? $lastTransaction->total : 0;
    }

    public function Balances()
    {
        return $this->hasMany(CustomerBalance::class);
    }
    public function createdBY()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
    public function getTotalOrdersSumAttribute()
    {
        return $this->orders->sum('total');
    }
    public function getTotalBalancesSumAttribute()
    {
        return $this->balances->sum('paid');
    }
    public function getRemainingBalancesAmountAttribute()
    {
        return $this->balances()->latest('remaining')->value('remaining') ?? 0;
    }

}
