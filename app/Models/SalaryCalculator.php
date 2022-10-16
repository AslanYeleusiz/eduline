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
            'name' => 'Нет',
            'percent' => 0
        ],
        [
            'number' => 2,
            'name' => 'педагог-модератор',
            'percent' => 50
        ],
        [
            'number' => 3,
            'name' => 'педагог-эксперт',
            'percent' => 40
        ],
        [
            'number' => 4,
            'name' => 'педагог-исследователь',
            'percent' => 35
        ],
        [
            'number' => 5,
            'name' => 'педагог-мастер',
            'percent' => 30
        ]
    ];

    const CATEGORIES = [
        [
            'number' => 1,
            'name' => 'Высшая категория'
        ],
        [
            'number' => 2,
            'name' => '2 '.'категория'
        ],
        [
            'number' => 3,
            'name' => '1 '.'категория'
        ],
        [
            'number' => 4,
            'name' => 'Без категории'
        ],
    ];
    const EDUICATIONS = [
        [
            "name"  => 'Высшее',
            "value" => "B2",
        ],
        [
            "name"  => 'Среднее специальное',
            "value" => "B4"
        ]
    ];

    const WORK_IN_ENVIRONMENTAL_DISASTER_ZONES = [

        [
            'number' => 1,
            'name' => 'Нет',
            'percent' => 0
        ],
        [
            'number' => 2,
            'name' => 'Зона экологической катастрофы',
            'percent' => 50
        ],
        [
            'number' => 3,
            'name' => 'Зона экологического кризиса',
            'percent' => 30
        ],

        [
            'number' => 4,
            'name' => 'Зона экологического предкризисного состояния',
            'percent' => 20
        ],
    ];
    const WORK_IN_RADIATION_RISK_ZONES = [
        [
            'number' => 1,
            'name' => 'Нет',
            'mrp' => 0
        ],
        [
            'number' => 2,
            'name' => 'Зона черезвычайного радиационнного риска',
            'mrp' => 2
        ],
        [
            'number' => 3,
            'name' => 'Зона максимального радиационнного риска',
            'mrp' => 1.75
        ],
        [
            'number' => 4,
            'name' => 'Зона повышенного радиационнного риска',
            'mrp' => 1.5
        ],

        [
            'number' => 5,
            'name' => 'Зона минимального радиационнного риска',
            'mrp' => 1.25
        ],

        [
            'number' => 6,
            'name' => 'Зона с льготным социально-экономическим статусом',
            'mrp' => 1
        ],
    ];

    const TECHING_IN_ENGLISH_ITEMS = [

        [
            'number' => 1,
            'name' => 'Нет',
            'bdo' => 0
        ],
        [
            'number' => 2,
            'name' => 'Частичное погружение' ,
            'bdo' => 1
        ],
        [
            'number' => 3,
            'name' => 'Полное погружение',
            'bdo' => 2
        ],
    ];
    const FOR_MANAGING_OFFICE_ITEMS = [

        [
            'number' => 1,
            'name' => 'Нет',
            'bdo_percent' => 0
        ],
        [
            'number' => 2,
            'name' => 'Половина дня',
            'bdo_percent' => 10
        ],
        [
            'number' => 3,
            'name' => 'Полный день',
            'bdo_percent' => 20
        ],
    ];
    const FOR_CHECKING_NOTEBOOKS =[

        [
            'number' => 1,
            'name' => 'Нет',
            'zchbdo_percent' => 0
        ],
        [
            'number' => 2,
            'name' => 'Учитель начальных классов',
            'zchbdo_percent' => 50
        ],
        [
            'number' => 3,
            'name' => 'Учитель ЕМН',
            'zchbdo_percent' => 50
        ],
        [
            'number' => 4,
            'name' => 'Учитель языка и литературы',
            'zchbdo_percent' => 50
        ],

    ];

    protected $guarded = [];
}
