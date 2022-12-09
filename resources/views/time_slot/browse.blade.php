@extends('layouts.master')

@section('title', 'Browse Branches')

@section('main')
  <div class="card">
    <h4 class="card-header">Browse Time Slots</h4>
    <div class="card-body">
      <div class="form-group row">
        <label for="movie-input" class="col-form-label col-md-3"> Movie </label>
        <div class="col-md-9">
          <select class="form-control" id="movie-input" onchange="timeSlotsTableHandler(this)">
            <option hidden disabled selected value> -- Choose a movie -- </option>
            @foreach ($movies as $movie)
              <option value="{{ $movie['id'] }}" @selected($movie['id'] == $movie_id)>
                {{ $movie['title'] }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
      <div id="ts-table" class="table-responsive" style="display: none;"></div>
    </div>
  </div>
@endsection
