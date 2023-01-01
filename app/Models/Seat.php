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


  /**
   * Get the price of a seat
   */
  public static function price($row, $column)
  {
    return ($row >= 3) ? 4 : 3;
  }

  /**
   * Get total price of multiple seats at once
   */
  public static function total_price(\Illuminate\Support\Collection $seats)
  {
    return
      $seats->reduce(
        fn ($carry, $item) => $carry + self::price(...$item),
        initial: 0,
      );
  }
}
