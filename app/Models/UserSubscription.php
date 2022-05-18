<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subscription(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFromDateAttribute($formDate): string
    {
        return date('d.m.Y', strtotime($formDate));
    }

    public function getToDateAttribute($toDate): string
    {
        return date('d.m.Y', strtotime($toDate));
    }
}
