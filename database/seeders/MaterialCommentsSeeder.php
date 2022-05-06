<?php

namespace Database\Seeders;

use App\Models\Material;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialCommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $texts = [
            'керемет',
            'Рахмет мұғалімдерге осындай қолдау  көрсеткендерин.',
            'Өте тамаша мақала',
            'Ұстаз  тілегі"  Республикалық  ұстаздар  сайтының',
            'Рахмет',
            'Тамаша!',
            'маған бұл сайыт ұнаты рахмет',
            'Осы материалдар ұстаздарымызға көмегін тігізеді де...',
            'Маған  бұл   сайт    ұнады.  Жылдам   әрі    тегін',
            'Рахмет',
            'Осы сайтқа тіркелгеніме өте қуаныштымын . Мұғалімд..'];

        $materials = Material::limit(20)->get();
        $users = User::limit(20)->get();
        foreach ($materials as $material) {
            $material->comments()->createMany([[
                'user_id' => $users->random()->id,
                'text' => $texts[rand(1,count($texts) - 1)]
            ],[
                'user_id' => $users->random()->id,
                'text' => $texts[rand(1,count($texts) - 1)]
            ],
            [
                'user_id' => $users->random()->id,
                'text' => $texts[rand(1,count($texts) - 1)]
            ],
            [
                'user_id' => $users->random()->id,
                'text' => $texts[rand(1,count($texts) - 1)]
            ]]);
        }
    }
}
