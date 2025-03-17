<?php

namespace Database\Factories;

use App\Models\Picture;
use Illuminate\Database\Eloquent\Factories\Factory;

class PictureFactory extends Factory
{
    protected $model = Picture::class;

    public function definition(): array
    {
        $name = $this->faker->word . '.png';
        $path = 'images/' . $name;

        Picture::generateImage($name);

        return [
            'name' => $name,
            'path' => $path,
        ];
    }
}
