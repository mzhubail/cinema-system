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

  /** Get the time slots belonging to this movie */
  public function time_slots()
  {
    return $this->hasMany(TimeSlot::class);
  }


  /**
   * Perform full text search in movie title
   *
   * @return \Illuminate\Database\Eloquent\Builder
   */
  public static function searchTitle(string $query)
  {
    return
      Movie::whereFullText('title', $query);
  }
}
