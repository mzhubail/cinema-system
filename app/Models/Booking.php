<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'payment_method',
    'time_slot_id',
    'customer_id',
    'row',
    'seats_start',
    'seats_end',
  ];

  /** Get the time_slot this booking belongs to */
  public function time_slot()
  {
    return $this->belongsTo(TimeSlot::class);
  }

  /** Get the seats of this booking */
  public function seats()
  {
    return $this->hasMany(Seats::class);
  }
}
