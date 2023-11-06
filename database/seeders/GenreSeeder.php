<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            'Народная музыка',
            'Духовная музыка',
            'Академическая музыка',
            'Популярная музыка',
            'Фолк-музыка',
            'Кантри',
            'Латиноамериканская музыка',
            'Блюз',
            'Ритм-н-блюз',
            'Джаз',
            'Шансон, романс, авторская песня',
            'Электронная музыка',
            'Рок',
            'Хип-хоп',
            'Регги',
            'Фанк',
            'Новая волна',
            'Соул',
            'Диско',
            'Поп-музыка',
        ];

        foreach ($genres as $genre) {
            Genre::create(['name' => $genre]);
        }
    }
}
