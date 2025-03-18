<?php

namespace Database\Factories;

use App\Enum\AgeRestriction;
use App\Enum\Language;
use App\Models\Movie;
use App\Models\CoverPicture;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->realTextBetween(10, 17),
            'description' => fake()->text,
            'age_restriction' => array_rand(array_flip(AgeRestriction::ageRestrictions())),
            'language' => array_rand(array_flip(Language::languages())),
        ];
    }
}
