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
    public PED_SKILLS = [
        [
            'number' => 1,
            'name' => __('site.Нет'),
            'percent' => 0
        ],
        [
            'number' => 2,
            'name' => __('site.педагог-модератор'),
            'percent' => 50
        ],
        [
            'number' => 3,
            'name' => __('site.педагог-эксперт'),
            'percent' => 40
        ],
        [
            'number' => 4,
            'name' => __('site.педагог-исследователь'),
            'percent' => 35
        ],
        [
            'number' => 5,
            'name' => __('site.педагог-мастер'),
            'percent' => 30
        ]
    ];

    public CATEGORIES = [
        [
            'number' => 1,
            'name' => __('site.Высшая категория')
        ],
        [
            'number' => 2,
            'name' => '2 '.__('site.категория')
        ],
        [
            'number' => 3,
            'name' => '1 '.__('site.категория')
        ],
        [
            'number' => 4,
            'name' => __('site.Без категории')
        ],
    ];
    public EDUICATIONS = [
        [
            "name"  => __('site.Высшее'),
            "value" => "B2",
        ],
        [
            "name"  => __('site.Среднее специальное'),
            "value" => "B4"
        ]
    ];

    public WORK_IN_ENVIRONMENTAL_DISASTER_ZONES = [

        [
            'number' => 1,
            'name' => __('site.Нет'),
            'percent' => 0
        ],
        [
            'number' => 2,
            'name' => __('site.Зона экологической катастрофы'),
            'percent' => 50
        ],
        [
            'number' => 3,
            'name' => __('site.Зона экологического кризиса'),
            'percent' => 30
        ],

        [
            'number' => 4,
            'name' => __('site.Зона экологического предкризисного состояния'),
            'percent' => 20
        ],
    ];
    public WORK_IN_RADIATION_RISK_ZONES = [
        [
            'number' => 1,
            'name' => __('site.Нет'),
            'mrp' => 0
        ],
        [
            'number' => 2,
            'name' => __('site.Зона черезвычайного радиационнного риска'),
            'mrp' => 2
        ],
        [
            'number' => 3,
            'name' => __('site.Зона максимального радиационнного риска'),
            'mrp' => 1.75
        ],
        [
            'number' => 4,
            'name' => __('site.Зона повышенного радиационнного риска'),
            'mrp' => 1.5
        ],

        [
            'number' => 5,
            'name' => __('site.Зона минимального радиационнного риска'),
            'mrp' => 1.25
        ],

        [
            'number' => 6,
            'name' => __('site.Зона с льготным социально-экономическим статусом'),
            'mrp' => 1
        ],
    ];

    public TECHING_IN_ENGLISH_ITEMS = [

        [
            'number' => 1,
            'name' => __('site.Нет'),
            'bdo' => 0
        ],
        [
            'number' => 2,
            'name' => __('site.Частичное погружение') ,
            'bdo' => 1
        ],
        [
            'number' => 3,
            'name' => __('site.Полное погружение'),
            'bdo' => 2
        ],
    ];
    public FOR_MANAGING_OFFICE_ITEMS = [

        [
            'number' => 1,
            'name' => __('site.Нет'),
            'bdo_percent' => 0
        ],
        [
            'number' => 2,
            'name' => __('site.Половина дня'),
            'bdo_percent' => 10
        ],
        [
            'number' => 3,
            'name' => __('site.Полный день'),
            'bdo_percent' => 20
        ],
    ];
    public FOR_CHECKING_NOTEBOOKS =[

        [
            'number' => 1,
            'name' => __('site.Нет'),
            'zchbdo_percent' => 0
        ],
        [
            'number' => 2,
            'name' => __('site.Учитель начальных классов'),
            'zchbdo_percent' => 50
        ],
        [
            'number' => 3,
            'name' => __('site.Учитель ЕМН'),
            'zchbdo_percent' => 50
        ],
        [
            'number' => 4,
            'name' => __('site.Учитель языка и литературы'),
            'zchbdo_percent' => 50
        ],

    ];

    protected $guarded = [];
}
