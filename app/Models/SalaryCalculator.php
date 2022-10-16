<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryCalculator extends Model
{
    use HasFactory;

    const STAVKI = [
        0.25, 0.5, 0.75, 1, 1.25, 1.5, 1.75, 2,
    ];
    const PED_SKILLS = [
        [
            'number' => 1,
            'name' => 'site.Нет',
            'percent' => 0
        ],
        [
            'number' => 2,
            'name' => 'site.педагог-модератор',
            'percent' => 50
        ],
        [
            'number' => 3,
            'name' => 'site.педагог-эксперт',
            'percent' => 40
        ],
        [
            'number' => 4,
            'name' => 'site.педагог-исследователь',
            'percent' => 35
        ],
        [
            'number' => 5,
            'name' => 'site.педагог-мастер',
            'percent' => 30
        ]
    ];

    const CATEGORIES = [
        [
            'number' => 1,
            'name' => 'site.Высшая категория'
        ],
        [
            'number' => 2,
            'name' => '2 '.'site.категория'
        ],
        [
            'number' => 3,
            'name' => '1 '.'site.категория'
        ],
        [
            'number' => 4,
            'name' => 'site.Без категории'
        ],
    ];
    const EDUICATIONS = [
        [
            "name"  => 'site.Высшее',
            "value" => "B2",
        ],
        [
            "name"  => 'site.Среднее специальное',
            "value" => "B4"
        ]
    ];

    const WORK_IN_ENVIRONMENTAL_DISASTER_ZONES = [

        [
            'number' => 1,
            'name' => 'site.Нет',
            'percent' => 0
        ],
        [
            'number' => 2,
            'name' => 'site.Зона экологической катастрофы',
            'percent' => 50
        ],
        [
            'number' => 3,
            'name' => 'site.Зона экологического кризиса',
            'percent' => 30
        ],

        [
            'number' => 4,
            'name' => 'site.Зона экологического предкризисного состояния',
            'percent' => 20
        ],
    ];
    const WORK_IN_RADIATION_RISK_ZONES = [
        [
            'number' => 1,
            'name' => 'site.Нет',
            'mrp' => 0
        ],
        [
            'number' => 2,
            'name' => 'site.Зона черезвычайного радиационнного риска',
            'mrp' => 2
        ],
        [
            'number' => 3,
            'name' => 'site.Зона максимального радиационнного риска',
            'mrp' => 1.75
        ],
        [
            'number' => 4,
            'name' => 'site.Зона повышенного радиационнного риска',
            'mrp' => 1.5
        ],

        [
            'number' => 5,
            'name' => 'site.Зона минимального радиационнного риска',
            'mrp' => 1.25
        ],

        [
            'number' => 6,
            'name' => 'site.Зона с льготным социально-экономическим статусом',
            'mrp' => 1
        ],
    ];

    const TECHING_IN_ENGLISH_ITEMS = [

        [
            'number' => 1,
            'name' => 'site.Нет',
            'bdo' => 0
        ],
        [
            'number' => 2,
            'name' => 'site.Частичное погружение' ,
            'bdo' => 1
        ],
        [
            'number' => 3,
            'name' => 'site.Полное погружение',
            'bdo' => 2
        ],
    ];
    const FOR_MANAGING_OFFICE_ITEMS = [

        [
            'number' => 1,
            'name' => 'site.Нет',
            'bdo_percent' => 0
        ],
        [
            'number' => 2,
            'name' => 'site.Половина дня',
            'bdo_percent' => 10
        ],
        [
            'number' => 3,
            'name' => 'site.Полный день',
            'bdo_percent' => 20
        ],
    ];
    const FOR_CHECKING_NOTEBOOKS =[

        [
            'number' => 1,
            'name' => 'site.Нет',
            'zchbdo_percent' => 0
        ],
        [
            'number' => 2,
            'name' => 'site.Учитель начальных классов',
            'zchbdo_percent' => 50
        ],
        [
            'number' => 3,
            'name' => 'site.Учитель ЕМН',
            'zchbdo_percent' => 50
        ],
        [
            'number' => 4,
            'name' => 'site.Учитель языка и литературы',
            'zchbdo_percent' => 50
        ],

    ];

    protected $guarded = [];
}
