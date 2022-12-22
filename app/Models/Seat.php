<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'booking_id',
    'row',
    'column',
  ];

  /**
   * The attributes that should be hidden for arrays.  Which means it will not
   * be shown when converting to json.
   *
   * @var array
   */
  protected $hidden = [
    'laravel_through_key'
  ];
}
