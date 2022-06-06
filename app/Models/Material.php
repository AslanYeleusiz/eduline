<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Material extends Model
{
    use HasFactory;
    const FILE_PATH = 'files/materials/';
    const CERTIFICATE_PATH = 'images/certificates/';

    const STATUS_DELETED_CREATED = 1;
    const STATUS_DELETED_REJECTED = 2;
    const STATUS_DELETED_ACCEPT = 3;
    public $guarded = [];

    public function journals()
    {
        return $this->hasMany(SendingMaterialJournal::class, 'material_id');
    }

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

    public function comments()
    {
        return $this->hasMany(MaterialComment::class,  'material_id','id');
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', 1);
    }

    public function getFilePathAttribute()
    {
        return Material::FILE_PATH . $this->created_at->format('Y')
        .'/'. $this->created_at->format('m') . '/' . $this->file_name;
    }
    public function createdAt($date)
{
    return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y');
}

public function updatedAt($date)
{
    return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d.m.Y');
}

    public $casts = [
        'is_active' => 'boolean'
    ];
}
