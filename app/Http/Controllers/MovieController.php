<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

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



  /**
   * Show the form for adding a movie
   */
  public function show_add_movie()
  {
    return view('movie.add');
  }



  /**
   * Store a new movie in database
   */
  public function store(Request $request)
  {
    Validator::make(
      data: $request->all(),
      rules: [
        'title' => 'required|unique:movies|min:5|max:31',
        'release_year' => 'required|integer|min:1980|max:2024',
        'duration' => 'required|date_format:H:i',
        'lang' => ['required', Rule::in(['ar', 'en', 'hu'])],
        // TODO: validate number of decimals
        'rating' => 'required|numeric',
        'genre' => ['required', Rule::in(config('constants.genres'))],
        'desc' => 'required|min:15|max:511|',
        'poster-img' => 'required|image|max:512',
      ],
      messages: [
        'poster-img.required' => 'A poster image is required',
      ],
      customAttributes: [
        'desc' => 'description',
        'poster-img' => 'poster image',
      ],
    )->validate();

    $input = $request->all();
    // Convert duration
    $input['duration'] = self::durationToSeconds($input['duration']);
    // Store image
    $input['img_path'] = $request
      ->file('poster-img')
      ->storePublicly('posters');
    Movie::create($input);
    session()->flash('message', "Movie Added succefully");
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



  /**
   * List the movies stored in the database
   */
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



  function show_edit(Request $request)
  {
    $movie = Movie::find($request->id);
    if ($movie === null) {
      session()->flash('message', ["Sorry, movie not found", "error"]);
      return redirect()->back();
    }
    $movie->duration = self::minutesToDuration($movie->duration);
    return view('movie.edit', ['movie' => $movie]);
  }

  function update(Request $request)
  {
    $request->validate([
      'movie' => 'required|exists:movies,id',
    ]);
    $movie = Movie::find($request->movie);
    // dd($movie->title);

    Validator::make(
      data: $request->all(),
      rules: [
        'title' => [
          'required',
          Rule::unique('movies', 'title')->ignore($movie->id),
          'min:5',
          'max:31',
        ],
        'release_year' => 'required|integer|min:1980|max:2024',
        'duration' => 'required|date_format:H:i',
        'lang' => ['required', Rule::in(['ar', 'en', 'hu'])],
        // TODO: validate number of decimals
        'rating' => 'required|numeric',
        'genre' => ['required', Rule::in(config('constants.genres'))],
        'desc' => 'required|min:15|max:511|',
        'poster-img' => 'image|max:512',
      ],
      messages: [
        'poster-img.required' => 'A poster image is required',
      ],
      customAttributes: [
        'desc' => 'description',
        'poster-img' => 'poster image',
      ],
    )->validate();

    $input = $request->all();
    $input['duration'] = self::durationToSeconds($input['duration']);

    if ($request->has('poster-img')) {
      // Delete old image
      Storage::delete($movie->img_path);
      // Upload new image
      $input['img_path'] = $request
        ->file('poster-img')
        ->storePublicly('posters');
    }
    $movie->fill($input);
    $movie->save();
    session()->flash('message', ["Movie updated succefully", "error"]);
    return redirect()->back();
  }
}
