<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LanguageSeeder::class);
        $this->call([CategorySeeder::class, TagSeeder::class, IngredientSeeder::class]);
        $this->call(MealSeeder::class);
        $this->call([MealIngredientSeeder::class, MealTagSeeder::class]);
        $this->call(ModifyMeals::class);
    }
}
