<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FullTestSubject extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function directions()
    {
        return $this->hasOne(TestDirectionTestSubject::class, 'subject_id', 'subject_id');
    }


}
