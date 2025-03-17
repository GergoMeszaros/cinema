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

        CoverPicture::generateImage($name);

        return [
            'name' => $name,
            'path' => $path,
            'movie_id' => ''
        ];
    }
}
