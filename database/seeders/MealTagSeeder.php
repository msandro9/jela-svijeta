<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Meal;
use Illuminate\Database\Seeder;

class MealTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $meals = Meal::withTrashed();
        $tags = Tag::all();

        $meals->each(function ($meal) use ($tags) {
            $meal->tags()->attach(
                $tags->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
