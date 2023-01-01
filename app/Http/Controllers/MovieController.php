<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Blade;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class MovieController extends Controller
{
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
    $input['duration'] = Movie::durationToSeconds($input['duration']);
    // Store image
    $input['img_path'] = $request
      ->file('poster-img')
      ->storePublicly('posters');
    Movie::create($input);
    session()->flash('message', "Movie Added succefully");
    return back();
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
        'formatted_duration' => Movie::minutesToDuration($movie->duration),
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
      return back();
    }

    // Format duration
    $movies->transform(function ($movie) {
      $movie['duration'] = Movie::minutesToDuration($movie['duration']);
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

  /**
   * List the coming soon moview
   */
  public function browse_coming_soon()
  {
    return view(
      'movie.coming_soon',
      ['movies' => Movie::coming_soon()->get()]
    );
  }

  /**
   * List new arrivals
   */
  public function browse_new_arrival()
  {
    return view(
      'movie.new_arrival',
      ['movies' => Movie::new_arrival()->get()]
    );
  }



  public function show_search()
  {
    return view('movie.search');
  }

  public function search(Request $request)
  {
    if ($request->missing('m'))
      return;

    // Must have at least one time slot in the next two weeks
    $query = Movie::whereHas('time_slots', function (Builder $query) {
      $query->whereDate('start_time', '>', now())
        ->whereDate('start_time', '<', now()->addWeeks(2));
    });

    $words = Str::of($request->q)
      ->split('/[\s]+/');
    foreach ($words as $word)
      $query->where('title', 'LIKE', "%$word%");


    if ($request->m == 'cards') {
      $movies = $query->get();
      foreach ($movies as $movie)
        echo Blade::render(
          '<x-movie-card :movie="$movie" />',
          ['movie' => $movie]
        );
    } elseif ($request->m == 'suggest') {
      $movies = $query
        ->select(['id', 'title'])
        ->get();
      foreach ($movies as $movie) {
        echo Blade::render(
          '<x-search-suggestion :movie="$movie" />',
          ['movie' => $movie]
        );
      }
    }
  }

  function show_edit(Request $request)
  {
    $movie = Movie::find($request->id);
    if ($movie === null) {
      session()->flash('message', ["Sorry, movie not found", "error"]);
      return back();
    }
    $movie->duration = Movie::minutesToDuration($movie->duration);
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
    $input['duration'] = Movie::durationToSeconds($input['duration']);

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
    return back();
  }
}
