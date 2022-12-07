<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
  use HasFactory;
  // Since the class name is Customer, laravel will assume that it is stored in table customers
  //protected $table = 'customers';

  // Laravel assumes the primary key is stored in id
  //protected $primaryKey = 'id';

  // By default, laravel stores timestamps in `created_at` and `updated_at`
  //public $timestamps = true;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    "fName",
    "lName",
    "email",
    "birthday",
    "hash",
    "credit",
  ];

  /**
   * The model's default values for attributes.
   *
   * @var array
   */
  // protected $attributes = [
  //     'credit' => 0,
  // ];
}
