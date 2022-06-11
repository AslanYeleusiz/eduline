<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

class MaterialEdit extends Model
{
    use HasFactory;
    public function subject()
    {
        return $this->belongsTo(MaterialSubject::class, 'subject_id')->withTrashed();
    }
    public function class()
    {
        return $this->belongsTo(MaterialClass::class, 'class_id')->withTrashed();
    }
    public function direction()
    {
        return $this->belongsTo(MaterialDirection::class, 'direction_id')->withTrashed();
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function material()
    {
        return $this->belongsTo(Material::class);
    }

}
