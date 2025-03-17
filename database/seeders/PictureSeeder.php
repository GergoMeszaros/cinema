<?php

namespace Database\Seeders;

use App\Models\Picture;
use Illuminate\Database\Seeder;

class PictureSeeder extends Seeder
{
    private const NUMBER_OF_PICTURES = 10;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Picture::factory()->count(self::NUMBER_OF_PICTURES)->create();
    }
}
