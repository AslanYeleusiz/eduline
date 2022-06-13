<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Material;
use App\Models\MaterialEdit;
use App\Models\MaterialSubject;
use App\Models\MaterialDirection;
use App\Models\MaterialClass;

class MaterialEditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $materials = Material::limit(20)->get();
        $users = User::get();
        $subjects = MaterialSubject::get();
        $directions = MaterialDirection::get();
        $classes = MaterialClass::get();
        $titles = [
            'Шамалар және олардың қасиеттері" сабақ жоспары',
            'Professions',
            'әріптестеріме көмек',
            'Family relationships 5 сынып',
            'Әлеуметтік мінез-құлық және оны реттеу',
            'Ашық сабақ. Аденозинүшфосфор қышқылының (АТФ) құры...',
            'Особенности русского романтизма',
        ];
        $descriptions = [
            'әріптестеріме көмек',
            'бұл материал ұстаздарға қажет болар деп ойлаймын',
            'Психология мамандығының студенттеріне арналған,Әлеуметтік мінез-құлық және оны реттеу',
            'How coulddefinite answer. In the 18th, 19th and at the beginning of the 20th century people used to get married at the age of 18 or even 16',
            'Материал биология пәні мұғалімдеріне қажет деп сан...',
            'Учащимся 9-х классов, для понимания и разъяснения',
        ];
        foreach ($materials as $material){
            $data = [
                'user_id' => $material->user->id,
                'material_id' => $material->id,
                'title' => $titles[rand(1, count($titles) - 1)],
                'description' => $descriptions[rand(1, count($descriptions) - 1)],
                'subject_id' => $subjects->find(rand(1, $subjects->count()))->id,
                'direction_id' => $directions->find(rand(1, $directions->count()))->id,
                'class_id' => $classes->find(rand(1, $classes->count()))->id,
                'status_edited' => 1,
            ];
            MaterialEdit::create($data);
        }
    }
}
