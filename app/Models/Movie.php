<?php

namespace App\Models;

use App\Enum\AgeRestriction;
use App\Enum\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Movie extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];
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

    public function showtimeDetails(): HasMany
    {
        return $this->hasMany(ShowtimeDetails::class)->orderBy('showtime');
    }
}
