<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'usertype',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->usertype === 'admin';
    }

    public function basket() {
        return $this->hasOne(Basket::class , 'user_id' , 'id');
    }

    public function order() {
        return $this->hasMany(Order::class , 'user_id' , 'id');
    }

    public function returnItems() {
        return $this->hasManyThrough(ReturnItem::class, Order::class, 'user_id', 'order_id');
    }

    public function orderitems() {
        return $this->hasManyThrough(OrderItem::class, Order::class, 'user_id', 'order_id', 'id', 'order_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id');
    }
}
