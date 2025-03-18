<?php

namespace Database\Factories;

use App\Models\CoverPicture;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class CoverPictureFactory extends Factory
{
    protected $model = CoverPicture::class;

    public function definition(): array
    {
        $name = $this->faker->word . '.png';
        $path = 'images/' . $name;
        $text = fake()->text(12);

        CoverPicture::generateImage($name, $text);

        return [
            'name' => $name,
            'path' => $path,
            'movie_id' => Movie::query()->inRandomOrder()->first()
        ];
    }
}
