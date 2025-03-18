<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\ShowtimeDetails;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShowtimeDetailsFactory extends Factory
{

    public function definition(): array
    {
        return [
            'showtime' => fake()->dateTimeBetween('now', '+1 day')->format('Y-m-d H:i'),
            'available_seats' => rand(1,100),
            'movie_id' => Movie::query()->inRandomOrder()->first()
        ];
    }
}
