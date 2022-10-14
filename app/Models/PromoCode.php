<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];
    // public function usedUsers()
    // {
    //     // return $this->hasMany(User::class);
    // }
    protected $casts = [
        'is_active' => 'boolean'
    ];


    public function scopeIsActive($query){
        return $query->where('is_active', 1);
    }
}
