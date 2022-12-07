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

  /** Get the TimeSlots belonging to this Hall */
  public function time_slots()
  {
    return $this->hasMany(TimeSlot::class);
  }

  /** Get the branch this hall belongs to */
  public function branch()
  {
    return $this->belongsTo(Branch::class);
  }
}
