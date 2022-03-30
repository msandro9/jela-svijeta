<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $locales = Language::pluck('locale')->toArray();

        $data = [
            'slug' => $this->faker->slug(2, false) .
                '-' . $this->faker->randomDigit() . $this->faker->randomDigit()
        ];

        foreach ($locales as $locale) {
            $data[$locale] = [
                'title' => "($locale) " .
                    $this->faker->words(3, true)
            ];
        }

        return $data;
    }
}
