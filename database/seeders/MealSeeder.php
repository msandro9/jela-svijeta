<?php

namespace Database\Seeders;

use App\Models\Meal;
use App\Models\Category;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::all()->each(function ($cateogry) {
            Meal::factory(15)->create(['category_id' => $cateogry->id]);
        });
        Meal::factory(30)->create();
    }
}
