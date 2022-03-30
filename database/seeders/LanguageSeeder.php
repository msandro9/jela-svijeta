<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $locales = config('translatable.locales');
        foreach ($locales as $locale) {
            Language::create(['locale' => $locale]);
        }
    }
}
