<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsCommentsSeeder extends Seeder
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
            'Вот да, никаких оскорблений там модерация не пропускала, просто кол-во лайков здравых мыслей превысило живой электорат',
            'Өте тамаша мақала',
            'Вообще-то фильтры даже слово дурак не пропускали, а удалили возможность комментировать - на политическом уровне',
            'Рахмет',
            'Тамаша!',
            'маған бұл сайыт ұнаты рахмет',
            'Бункерный дед сам будет решать, когда вернуть, ваше мнение, как и мнение всей страны его не интересует.',
            'Маған  бұл   сайт    ұнады.  Жылдам   әрі    тегін',
            'Разве фильм от "Марвел" может быть плохим❓ К сожалению, может... даже звездный каст не смог вытянуть бредовый и вялотекущий сюжет. "Вечные" → отзыв без спойлеров',
            'На лимузине в McDonalds или куда делись миллионы одного из самых богатых бизнесменов Америки? ',
            'Женщина, создавшая "Франкенштейна", заслуживает большего.',
            'Рыдаю, проклинаю, но ради Нагиева одним глазом посмотрела..'
        ];

        $newsItems = News::limit(20)->get();
        $users = User::limit(20)->get();
        foreach ($newsItems as $newsItem) {
            $newsItem->comments()->createMany([[
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
