<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
  /** Converts duration from hh:mm format to number of seconds */
  static public function durationToSeconds(string $duration): int | null
  {
    if (preg_match('/^(\d{1,2}):(\d{2})$/', $duration, $matches)) {
      return ($matches[1] * 60) + $matches[2];
    } else {
      return null;
    }
  }

  public function show_add_movie()
  {
    return view('add_movie');
  }

  public function store(Request $request)
  {
    // Add image validation
    $input = $request->all();
    $input['duration'] = self::durationToSeconds($input['duration']);
    $input['imgPath'] = $request->file('poster-img')->store('posters');
    Movie::create($input);
    return view(
      'add_movie',
      [
        'message' => [
          'content' => 'Image uploaded successfully'
        ]
      ]
    );
  }
}
