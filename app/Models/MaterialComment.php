<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaterialComment extends Model
{
    use HasFactory;
    public $guarded = [];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public $casts = [

        'created_at' => 'datetime:d.m.Y'
    ];
}
