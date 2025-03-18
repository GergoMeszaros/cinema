<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\File;

class CoverPicture extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at', 'id', 'movie_id', 'name'];
    protected $fillable = ['name', 'path'];

    public static function generateImage(string $name, string $text = 'Sample Cover Text'): void
    {
        $directory = public_path('images');

        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0777, true);
        }

        $image = imagecreatetruecolor(200, 200);
        $blue = imagecolorallocate($image, 0, 0, 255);
        $black = imagecolorallocate($image, 0, 0, 0);

        imagefilledrectangle($image, 0, 0, 199, 199, $blue);
        imagestring($image, 5, 50, 90, $text, $black);
        $filePath = 'images/' . $name;

        imagepng($image, public_path($filePath));
        imagedestroy($image);
    }

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}
