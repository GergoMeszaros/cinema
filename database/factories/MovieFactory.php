<?php

namespace Database\Factories;

use App\Enum\AgeRestriction;
use App\Enum\Language;
use App\Models\Movie;
use App\Models\Picture;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->realTextBetween(10, 17),
            'description' => fake()->text,
            'age_restriction' => array_rand(array_flip(AgeRestriction::ageRestrictions())),
            'language' => array_rand(array_flip(Language::languages())),
            'cover_picture_id' => Picture::query()->inRandomOrder()->first()->id
        ];
    }
}
