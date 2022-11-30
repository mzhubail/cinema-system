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

  /** Converts duration from number of minutes to hh:mm format */
  function minutesToDuration(int $minutes): string
  {
    $h = $minutes / 60;
    $m = $minutes % 60;
    return sprintf("%02d:%02d", $h, $m);
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
    $input['imgPath'] = $request
      ->file('poster-img')
      ->storePublicly('posters');
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

  public function show(Request $request)
  {
    if (!$request->has('id'))
      die("no image id was given");
    $movie =
      Movie::where('id', $request->id)
      ->first();
    if ($movie === null)
      die("No movie was found");
    return view(
      'movie_details',
      [
        'movie' => $movie,
        'formatted_duration' => self::minutesToDuration($movie->duration),
      ]
    );
  }

  public function browse()
  {
    $movies = Movie::get();
    $header = [
      "id" => "ID",
      "title" => "Title",
      "releaseYear" => "Release Year",
      "lang" => "Language",
      "duration" => "Duration",
      "rating" => "Rating",
      "genre" => "Genre"
    ];

    return view(
      'browse_movies',
      [
        'movies' => $movies,
        'header' => $header,
      ]
    );
  }
}
