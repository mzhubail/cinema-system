<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name',
    'addr',
  ];

  /** Get halls belonging to this branch */
  public function halls()
  {
    return $this->hasMany(Hall::class);
  }
}
