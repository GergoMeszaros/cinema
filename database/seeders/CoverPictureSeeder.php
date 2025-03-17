<?php

namespace Database\Seeders;

use App\Models\CoverPicture;
use Illuminate\Database\Seeder;

class CoverPictureSeeder extends Seeder
{
    private const NUMBER_OF_PICTURES = 10;

    public function run(): void
    {
        $movieIds = range(1, 10);

        foreach ($movieIds as $movieId) {
            CoverPicture::factory()->create([
                'movie_id' => $movieId
            ]);
        }
    }
}
