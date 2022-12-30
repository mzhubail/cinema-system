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


  /** Converts duration from hh:mm format to number of seconds */
  static public function durationToSeconds(string $duration): int | null
  {
    if (preg_match('/^(\d{1,2}):(\d{2})$/', $duration, $matches)) {
      return ($matches[1] * 60) + $matches[2];
    } else {
      return null;
    }
  }


  /** Converts duration from number of minutes to hh:mm format */
  static public function minutesToDuration(int $minutes): string
  {
    $h = $minutes / 60;
    $m = $minutes % 60;
    return sprintf("%02d:%02d", $h, $m);
  }
}
