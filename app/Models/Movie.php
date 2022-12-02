<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'release_year',
        'lang',
        'duration',
        'rating',
        'genre',
        'desc',
        'img_path',
    ];

    /** Returns the TimeSlots belonging to this Movie */
    public function time_slots() {
        return $this->hasMany(TimeSlot::class);
    }
}
