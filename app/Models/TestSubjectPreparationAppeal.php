<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSubjectPreparationAppeal extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    const TYPES = [
        [
           'id' => 1,
           'name' => 'Тақырыбында грамматикалық қате бар'
        ],
        [
           'id' => 2,
           'name' => 'Мазмұнында қателік бар'
        ],
        [
           'id' => 3,
           'name' => 'Басқа қателер'
        ]
   ];
   public function user()
   {
       return $this->belongsTo(User::class);
   }

   public function preparation()
   {
       return $this->belongsTo(TestSubjectPreparation::class);
   }
}
