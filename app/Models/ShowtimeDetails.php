<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShowtimeDetails extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at', 'id', 'movie_id'];

    protected $fillable = [
        'showtime',
        'available_seats',
        'movie_id',
    ];

    public function movie(): BelongsTo
{
    return $this->belongsTo(Movie::class);
}
}
