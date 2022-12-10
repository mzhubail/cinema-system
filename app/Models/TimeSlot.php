<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'start_time',
    'hall_id',
    'movie_id',
  ];

  /** Get the bookings belonging to this time slot */
  public function bookings()
  {
    return $this->hasMany(Booking::class);
  }

  /** Get the seats belonging to this time slot */
  public function seats()
  {
    return $this->hasManyThrough(Seat::class, Booking::class);
  }

  /** Get the movie of this time slot */
  public function movie()
  {
    return $this->belongsTo(Movie::class);
  }

  /** Get the hall this time slot belongs to */
  public function hall()
  {
    return $this->belongsTo(Hall::class);
  }

  /** Get the branch this time slot belongs to */
  public function branch()
  {
    return $this->hall->branch();
  }
}
