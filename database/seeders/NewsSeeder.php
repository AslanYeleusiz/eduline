<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\NewsType;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Storage;


class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  News::factory(10)->create();
        $faker = Container::getInstance()->make(Generator::class);
        if(!Storage::disk('public')->exists('images/news')) {
            Storage::disk('public')->makeDirectory('images/news');
        }

        $newsTypes =  NewsType::inRandomOrder()->get();
        $data = [
            [
                'title' => [
                    'ru' => 'В Казахстане стартовал прием заявлений на основное ЕНТ-2022',
                    'kk' => 'Қазақстанда 2022 жылғы негізгі ҰБТ-ға өтініштер қабылдау басталды',
                ],
                'short_description' => [
                    'ru' => 'Количество предметов остается прежним – три обязательных и два на выбор. Число тестовых заданий – 120. Из них по истории Казахстана – 15, по математической грамотности – 15, по грамотности чтения – 20 и по 35 заданий по двум профильным предметам. Максимальное количество баллов – 140.',
                    'kk' => 'Пәндердің саны өзгеріссіз қалады-үш міндетті және екеуі таңдау керек. Тест тапсырмаларының саны-120. Оның ішінде Қазақстан тарихы бойынша – 15, математикалық сауаттылық бойынша – 15, оқу сауаттылығы бойынша – 20 және екі бейінді пән бойынша 35 тапсырма. Ең жоғарғы ұпай саны – 140.',
                ],
                'description' => [
                    'ru' => 'Как отметили в МОН РК, для соблюдения академической честности тестовый вариант абитуриентов будет промаркирован. То есть у каждого участника ЕНТ будет свой личный вариант тестов. В случае нарушения правил и попытке выноса тестовых заданий за пределы аудитории Национальный центр тестирования сможет определить нарушителя, результаты которого будут аннулированы.',
                    'kk' => 'ҚР БҒМ атап өткендей, академиялық адалдықты сақтау үшін талапкерлердің тесттік нұсқасы таңбаланатын болады. Яғни, ҰБТ-ның әрбір қатысушысының жеке тест нұсқасы болады. Ережелерді бұзған және тест тапсырмаларын аудиториядан тыс шығаруға тырысқан жағдайда Ұлттық тестілеу орталығы бұзушыны анықтай алады, оның нәтижелері жойылады.'
                ],
                'news_types_id' => $newsTypes->random()->first()->id,
                'view' => rand(0, 100000),
                'image' => [
                    'ru' => $faker->image(Storage::disk('public')->path('images/news'), 300, 300),
                    'kk' => $faker->image(Storage::disk('public')->path('images/news'), 300, 300)
                ]
            ]
        ];
    
        foreach ($data as $datum) {
            News::create($datum);
        }
    }
}
