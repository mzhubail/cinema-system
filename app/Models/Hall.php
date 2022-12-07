<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hall extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'letter',
  ];

  // TODO: figure what on earth is going on with this comment
  /** Returns the TimeSlots belonging to this Hall */
  public function time_slots()
  {
    return $this->hasMany(TimeSlot::class);
  }
}
