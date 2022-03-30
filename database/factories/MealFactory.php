<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Meal>
 */
class MealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $locales = Language::pluck('locale')->toArray();

        $data = [];

        foreach ($locales as $locale) {
            $data[$locale] = [
                'title' => "($locale) " .
                    $this->faker->words(3, true),
                'description' => "($locale) " .
                    $this->faker->sentence()
            ];
        }

        return $data;
    }
}
