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
}
