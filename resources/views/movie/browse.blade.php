@extends('layouts.master')

@section('title', 'Browse Movies')

@section('main')
  <div class="container">
    <div class="table-responsive">
      <table class="table table-striped">
        <thead>
          <tr>
            @foreach (array_values($header) as $cell)
              <th scope="col"><?= $cell ?></th>
            @endforeach
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($movies as $movie)
            <tr>
              @foreach (array_keys($header) as $k)
                <td> {{ $movie[$k] }} </td>
              @endforeach
              <td>
                <!-- TODO: Add admin functionalities instead of customer movie_details.php -->
                <a href="/movie_details?id={{ $movie->id }}" class="mr-2"> View details </a>
                <a href="/edit_movie?id={{ $movie->id }}"> Edit </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
