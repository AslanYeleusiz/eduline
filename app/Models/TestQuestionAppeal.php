<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestQuestionAppeal extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    const TYPES = [
         [
            'id' => 1,
            'name' => 'Сұрақта грамматикалық қате бар'
         ],
         [
            'id' => 2,
            'name' => 'Жауабы қате'
         ],
         [
            'id' => 3,
            'name' => 'Сұрақтың мазмұнында қателік бар'
         ],
         [
            'id' => 4,
            'name' => 'Жауап нұсқалары бірдей'
         ],
         [
            'id' => 5,
            'name' => 'Басқа қателер'
         ]
    ];
}
