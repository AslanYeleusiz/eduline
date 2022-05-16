<?php

namespace Database\Seeders;

use App\Models\TestLanguage;
use App\Models\TestSubject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TestSubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataKk = [


            'Алғашқы әскери технологиялық дайындық',
            'Арнайы педагогика',
            'Ағылшын тілі',
            'Адам. Қоғам. Құқық',
            'Бастауыш сынып',
            'Биология',
            'География',
            'Дене шынықтыру',
            'Логопед/Дефектология',
            'Информатика',
            'Әлеуметтік педагогика',
            'Зайырлылық және дінтану негіздері',
            'Көркем еңбек (қыз балаларға арналған)',
            'Көркем еңбек (ұл балаларға арналған)',
            'Қазақ тілі мен әдебиеті',
            'Математика',
            'Музыка',
            'Өзін-өзі тану',
            'Сызу – бейнелеу өнері',
            'Педагог-психологтарға арналған психология',
            'Қазақстан тарихы',
            'Дүниежүзі тарихы',
            'Физика',
            'Химия',
            'Экономика және қаржылық сауаттылық негіздері',
            'Орыс тілінде оқытпайтын мектептердегі орыс тілі мен әдебиеті'

        ];
        $dataRu = [
            'Английский язык',
            'Биология',
            'География',
            'Логопед/Дефектология',
            'Информатика',
            'Математика',
            'Музыка',
            'Начальная военная подготовка',
            'Начальные классы',
            'Психология для педагогов-психологов',
            'Русский язык и литература',
            'Самопознание',
            'Светскость и основы религиоведения',
            'Художественный труд (для девочек)',
            'Художественный труд (для мальчиков)',
            'Физика',
            'Физическая культура',
            'Химия',
            'История Казахстана',
            'Всемирная история',
            'Казахский язык и литература',
            'Основы права',
            'Основы экономики и финансовой грамотности',
            'Специальная педагогика',
            'Социальная педагогика',
        ];
        $languages = TestLanguage::get();
        $languageKk = 'Қазақша';
        $languageRu = 'Русский';
        $languageKk = $languages->filter(fn($item) => Str::contains($item->name, $languageKk))->first();
        $languageRu = $languages->filter(fn($item) => Str::contains($item->name, $languageRu))->first();
        if($languageKk && $languageKk->id) {
            foreach($dataKk as $datumKk) {
                TestSubject::create([
                    'language_id' => $languageKk->id,
                    'name' => $datumKk
                ]);
            }
        }
        if($languageRu && $languageRu->id) {
            foreach($dataRu as $datumRu) {
                TestSubject::create([
                    'language_id' => $languageRu->id,
                    'name' => $datumRu
                ]);
            }
            }
    }
}
