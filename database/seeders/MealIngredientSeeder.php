<?php

namespace Database\Seeders;

use App\Models\Meal;
use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class MealIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meals = Meal::withTrashed();
        $ingredients = Ingredient::all();

        $meals->each(function ($meal) use ($ingredients) {
            $meal->ingredients()->attach(
                $ingredients->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
