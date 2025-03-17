<?php

namespace App\Models;

use App\Enum\AgeRestriction;
use App\Enum\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Movie extends Model
{
    use HasFactory;

    protected $casts = [
        'age_restriction' => AgeRestriction::class,
        'language' => Language::class,
    ];

    protected $fillable = [
        'title',
        'description',
        'age_restriction',
        'language',
        'cover_picture_id',
    ];

    public function coverPicture(): HasOne
    {
        return $this->hasOne(CoverPicture::class);
    }
}
