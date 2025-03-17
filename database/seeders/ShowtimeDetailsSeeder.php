<?php

namespace Database\Seeders;

use App\Models\ShowtimeDetails;
use Illuminate\Database\Seeder;

class ShowtimeDetailsSeeder extends Seeder
{
    private const NUMBER_OF_SHOWTIMES = 15;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShowtimeDetails::factory()->count(self::NUMBER_OF_SHOWTIMES)->create();
    }
}
