<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
        	'name' => 'Вейкборды'
        ]);

        Category::create([
        	'name' => 'Двухколесные скейты'
        ]);

        Category::create([
        	'name' => 'Роликовые коньки'
        ]);

        Category::create([
        	'name' => 'Самокаты'
        ]);

        Category::create([
        	'name' => 'Сноуборды'
        ]);

        Category::create([
        	'name' => 'Теннисные ракеты'
        ]);
    }
}
