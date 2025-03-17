<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Picture extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path'];

    /**
     * Generate an image with PHP GD and store it in the public folder.
     *
     * @param string $name
     * @return void
     */
    public static function generateImage(string $name, string $text = 'Sample Cover Text'): void
    {
        $directory = public_path('images');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0777, true);
        }

        $image = imagecreatetruecolor(200, 200);
        $white = imagecolorallocate($image, 255, 255, 255);
        $black = imagecolorallocate($image, 0, 0, 0);

        imagefilledrectangle($image, 0, 0, 199, 199, $white);
        imagestring($image, 5, 50, 90, $text, $black);
        $filePath = 'images/' . $name;

        imagepng($image, public_path($filePath));
        imagedestroy($image);
    }
}
