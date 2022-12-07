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
  static public function minutesToDuration(int $minutes): string
  {
    $h = $minutes / 60;
    $m = $minutes % 60;
    return sprintf("%02d:%02d", $h, $m);
  }

  public function show_add_movie()
  {
    return view('movie.add');
  }

  public function store(Request $request)
  {
    // Add image validation
    $input = $request->all();
    $input['duration'] = self::durationToSeconds($input['duration']);
    $input['img_path'] = $request
      ->file('poster-img')
      ->storePublicly('posters');
    Movie::create($input);
    session()->flash('message', ["Movie Added succefully", "error"]);
    return redirect()->refresh();
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
      'movie.details',
      [
        'movie' => $movie,
        'formatted_duration' => self::minutesToDuration($movie->duration),
      ]
    );
  }

  public function browse()
  {
    $movies = Movie::get();

    if ($movies->isEmpty()) {
      session()->flash('message', ["Sorry, no movies where found", "error"]);
      return redirect()->back();
    }

    // Format duration
    $movies->transform(function ($movie) {
      $movie['duration'] = self::minutesToDuration($movie['duration']);
      return $movie;
    });

    $header = [
      "id" => "ID",
      "title" => "Title",
      "release_year" => "Release Year",
      "lang" => "Language",
      "duration" => "Duration",
      "rating" => "Rating",
      "genre" => "Genre"
    ];

    return view(
      'movie.browse',
      [
        'movies' => $movies,
        'header' => $header,
      ]
    );
  }
}
