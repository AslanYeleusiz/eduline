<?php

namespace Database\Seeders;

use App\Models\MaterialDirection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialDirectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Барлық материалдар',
            ],
            [
                'name' => 'Мақала',
            ],
            [
                'name' => 'Ашық сабақ',
            ],
            [
                'name' => 'Презентация',
            ],
            [
                'name' => 'Сабақ жоспары',
            ],
            [
                'name' => 'Тест',
            ],
            [
                'name' => 'Тәрбие сағаты',
            ],
            [
                'name' => 'Семинарлар',
            ],
            [
                'name' => 'Конспект',
            ],
            [
                'name' => 'Ғылыми жұмыстар',
            ],
            [
                'name' => 'Ойындар, Сценарийлер',
            ],
            [
                'name' => 'Тәлімгерлерге',
            ],
            [
                'name' => 'Тренерлерге',
            ],
            [
                'name' => 'Эссе, шығарма, мазмұндама',
            ],
            [
                'name' => 'Өлең, ертегі, әңгімелер',
            ],
            [
                'name' => 'Ақын жазушылар, ұлағатты сөздер',
            ],
            [
                'name' => 'Жұмбақтар, жаңылтпаштар, әзілдер',
            ],
            [
                'name' => 'Көрнекілік',
            ],
            [
                'name' => 'Портфолио',
            ],
            [
                'name' => 'Коучинг жоспары',
            ],
            [
                'name' => 'Сыныптан тыс жұмыс',
            ],
            [
                'name' => 'Оқушылар жұмысы',
            ],
            [
                'name' => 'Авторлық бағдарлама',
            ],
            [
                'name' => 'Оқу жылы',
            ],
            [
                'name' => 'Ата-аналармен жұмыс',
            ],
            [
                'name' => 'Баяндамалар, реферат',
            ],    
            [
                'name' => 'Басқа',
            ],
        ];
        foreach($data as $datum) {
            MaterialDirection::create($datum);
        } 
    }
}
