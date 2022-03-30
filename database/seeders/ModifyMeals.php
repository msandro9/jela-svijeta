<?php

namespace Database\Seeders;

use App\Models\Meal;
use Illuminate\Database\Seeder;

class ModifyMeals extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mealsToModify = Meal::all()->random(30)->each(function ($meal) {
            $meal->touch();
        });
        $mealsToSoftDelete = Meal::all()->random(20)->pluck('id')->toArray();
        Meal::destroy($mealsToSoftDelete);
    }
}
