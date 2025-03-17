<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    private const NUMBER_OF_MOVIES = 10;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::factory()->count(self::NUMBER_OF_MOVIES)->create();
    }
}
