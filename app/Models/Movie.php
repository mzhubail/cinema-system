<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
   * get coming soon movies
   *
   * @return \illuminate\database\eloquent\builder
   */
  public static function coming_soon()
  {
    return
      // Must have at least one time slot
      movie::has('time_slots')
      // Doesn't have a time slot in the past
      ->wheredoesnthave('time_slots', function (builder $query) {
        $query->wheredate('start_time', '<', now());
      });
  }


  /**
   * get new arrivals
   *
   * @return \illuminate\database\eloquent\builder
   */
  public static function new_arrival()
  {
    return
      // Must have at least one time slot
      movie::has('time_slots')
      // Must have at least one time slot in the past week
      ->whereHas('time_slots', function (Builder $query) {
        $query->whereDate('start_time', '<', now())
          ->whereDate('start_time', '>', now()->subWeek());
      })
      // Doesn't have a time slot before the past week
      ->wheredoesnthave('time_slots', function (builder $query) {
        $query->whereDate('start_time', '<', now()->subWeek());
      });
  }


  /**
   * get movies to be displayed in the home page
   *
   * @return \illuminate\database\eloquent\builder
   */
  public static function home_page_movies()
  {
    return
      // Must have at least one time slot
      movie::has('time_slots')
      // Must have at least one time slot in the next two weeks
      ->whereHas('time_slots', function (Builder $query) {
        $query->whereDate('start_time', '>', now())
          ->whereDate('start_time', '<', now()->addWeeks(2));
      });
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
