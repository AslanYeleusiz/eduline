<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SendingMaterialJournal extends Model
{
    use HasFactory;

    public $guard = [];

    const STATUS_REJECTED = 1;
    const STATUS_ACCEPT = 2; 


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
