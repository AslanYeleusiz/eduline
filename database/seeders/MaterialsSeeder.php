<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\MaterialSubject;
use App\Models\MaterialDirection;
use App\Models\MaterialClass;

class MaterialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::get();
        $subjects = MaterialSubject::get();
        $directions = MaterialDirection::get();
        $classes = MaterialClass::get();
        $data = [
            [
                'title' => 'Шамалар және олардың қасиеттері" сабақ жоспары',
                'description' => 'әріптестеріме көмек',
                'user_id' => $users[1]->id,
                'subject_id' => $subjects->find(rand(1, $subjects->count()))->id,
                'direction_id' => $directions->find(rand(1, $directions->count()))->id,
                'class_id' => $classes->find(rand(1, $classes->count()))->id,
                'file_name' => '1601793082.docx',
                'view' => 7,
                'download' => 6,
            ],
            [
                'title' => 'Professions',
                'description' => 'бұл материал ұстаздарға қажет болар деп ойлаймын',
                'user_id' => $users[2]->id,
                'subject_id' => $subjects->find(rand(1, $subjects->count()))->id,
                'direction_id' => $directions->find(rand(1, $directions->count()))->id,
                'class_id' => $classes->find(rand(1, $classes->count()))->id,
                'file_name' => '1601797121.docx',
                'view' => 6,
                'download' => 8,
            ],
            [
                'title' => 'Әлеуметтік мінез-құлық және оны реттеу ',
                'description' => ' Психология мамандығының студенттеріне арналған,Әлеуметтік мінез-құлық және оны реттеу',
                'user_id' => $users[2]->id,
                'subject_id' => $subjects->find(rand(1, $subjects->count()))->id,
                'direction_id' => $directions->find(rand(1, $directions->count()))->id,
                'class_id' => $classes->find(rand(1, $classes->count()))->id,
                'file_name' => '1605174370.pptx',
                'view' => 8,
                'download' => 9,
            ],
            [
                'title' => 'Family relationships 5 сынып',
                'description' => 'How coulddefinite answer. In the 18th, 19th and at the beginning of the 20th century people used to get married at the age of 18 or even 16',
                'user_id' => $users[2]->id,
                'subject_id' => $subjects->find(rand(1, $subjects->count()))->id,
                'direction_id' => $directions->find(rand(1, $directions->count()))->id,
                'class_id' => $classes->find(rand(1, $classes->count()))->id,
                'file_name' => '1605174476.pdf',
                'view' => 34,
                'download' => 34,
            ],
            [
                'title' => 'Ашық сабақ. Аденозинүшфосфор қышқылының (АТФ) құры...',
                'description' => 'Материал биология пәні мұғалімдеріне қажет деп сан...',
                'user_id' => $users[3]->id,
                'subject_id' => $subjects->find(rand(1, $subjects->count()))->id,
                'direction_id' => $directions->find(rand(1, $directions->count()))->id,
                'class_id' => $classes->find(rand(1, $classes->count()))->id,
                'file_name' => '1601793469.docx',
                'view' => 5,
                'download' => 0,
            ],
            [
                'title' => 'Особенности русского романтизма',
                'description' => 'Учащимся 9-х классов, для понимания и разъяснения ',
                'user_id' => $users[4]->id,
                'subject_id' => $subjects->find(rand(1, $subjects->count()))->id,
                'direction_id' => $directions->find(rand(1, $directions->count()))->id,
                'class_id' => $classes->find(rand(1, $classes->count()))->id,
                'file_name' => '1601789537.docx',
                'view' => 3,
                'download' => 2,
            ],
            [
                'title' => 'Шамалар және олардың қасиеттері" сабақ жоспары',
                'description' => 'әріптестеріме көмек',
                'user_id' => $users[5]->id,
                'subject_id' => $subjects->find(rand(1, $subjects->count()))->id,
                'direction_id' => $directions->find(rand(1, $directions->count()))->id,
                'class_id' => $classes->find(rand(1, $classes->count()))->id,
                'file_name' => '1601793082.docx',
                'view' => 7,
                'download' => 6,
            ],
            [
                'title' => 'Professions',
                'description' => 'бұл материал ұстаздарға қажет болар деп ойлаймын',
                'user_id' => $users[6]->id,
                'subject_id' => $subjects->find(rand(1, $subjects->count()))->id,
                'direction_id' => $directions->find(rand(1, $directions->count()))->id,
                'class_id' => $classes->find(rand(1, $classes->count()))->id,
                'file_name' => '1601797121.docx',
                'view' => 6,
                'download' => 8,
            ],
            [
                'title' => 'Ашық сабақ. Аденозинүшфосфор қышқылының (АТФ) құры...',
                'description' => 'Материал биология пәні мұғалімдеріне қажет деп сан...',
                'user_id' => $users[7]->id,
                'subject_id' => $subjects->find(rand(1, $subjects->count()))->id,
                'direction_id' => $directions->find(rand(1, $directions->count()))->id,
                'class_id' => $classes->find(rand(1, $classes->count()))->id,
                'file_name' => '1601793469.docx',
                'view' => 5,
                'download' => 0,
            ],
            [
                'title' => 'Особенности русского романтизма',
                'description' => 'Учащимся 9-х классов, для понимания и разъяснения ',
                'user_id' => $users[8]->id,
                'subject_id' => $subjects->find(rand(1, $subjects->count()))->id,
                'direction_id' => $directions->find(rand(1, $directions->count()))->id,
                'class_id' => $classes->find(rand(1, $classes->count()))->id,
                'file_name' => '1601789537.docx',
                'view' => 3,
                'download' => 2,
            ],
            [
                'title' => 'Шамалар және олардың қасиеттері" сабақ жоспары',
                'description' => 'әріптестеріме көмек',
                'user_id' => $users[9]->id,
                'subject_id' => $subjects->find(rand(1, $subjects->count()))->id,
                'direction_id' => $directions->find(rand(1, $directions->count()))->id,
                'class_id' => $classes->find(rand(1, $classes->count()))->id,
                'file_name' => '1601793082.docx',
                'view' => 7,
                'download' => 6,
            ],
            [
                'title' => 'Professions',
                'description' => 'бұл материал ұстаздарға қажет болар деп ойлаймын',
                'user_id' => $users[4]->id,
                'subject_id' => $subjects->find(rand(1, $subjects->count()))->id,
                'direction_id' => $directions->find(rand(1, $directions->count()))->id,
                'class_id' => $classes->find(rand(1, $classes->count()))->id,
                'file_name' => '1601797121.docx',
                'view' => 6,
                'download' => 8,
            ],
            [
                'title' => 'Шамалар және олардың қасиеттері" сабақ жоспары',
                'description' => 'әріптестеріме көмек',
                'user_id' => $users[11]->id,
                'subject_id' => $subjects->find(rand(1, $subjects->count()))->id,
                'direction_id' => $directions->find(rand(1, $directions->count()))->id,
                'class_id' => $classes->find(rand(1, $classes->count()))->id,
                'file_name' => '1601793082.docx',
                'view' => 7,
                'download' => 6,
            ],
        ];
        DB::table('materials')->insert($data);
    }
}
