<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     public $guarded = [];

      const IMAGE_PATH = 'images/avatars/';
      const DEFAULT_LANGUAGE = 'kk';
      const LANGUAGES =  ['kk', 'ru'];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function isAdmin($query)
    {
        return $query->where('role_id', Role::ADMIN_ROLE);
        # code...
    }

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function subscription()
    {
        $date = now();
        // return $this->belongsToMany(Subscription::class, 'user_subscriptions','user_id', 'subscription_id')
        return $this->hasOne(UserSubscription::class,'user_id')
        ->whereDate('from_date','<=',$date)->whereDate('to_date','>=',$date)
        // ->leftJoin('subscriptions', 'user_subscriptions.subscription_id', 'subscriptions.id')
        ->orderByDesc('id');
        // ->whereBetween(now(), ['from_date', 'to_date']);
    }

    public function scopePhoneBy($query,$phone)
    {
        return $query->where('phone', $phone);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_email_verified' => 'boolean'
    ];
}
