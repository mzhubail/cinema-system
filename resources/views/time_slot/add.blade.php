@extends('layouts.master')

@section('title', 'Add Branch')

@section('main')
  <div class="container" style="max-width: var(--breakpoint-md);">
    <form method="post">
      @csrf
      <div class="card">
        <h4 class="card-header"> Add time slot </h4>
        <div class="card-body">
          <div class="form-group">
            <label for="branch-input">Movie</label>
            @isset($movies)
              <select class="form-control" name="mid" id="movie-input">
                <option hidden disabled selected value> -- Choose a movie -- </option>
                @foreach ($movies as $movie)
                  <option value="{{ $movie['id'] }}">
                    {{ $movie['title'] }}
                  </option>
                @endforeach
              </select>
            @else
              <select class="form-control" name="mid" id="movie-input"> </select>

            @endisset
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="branch-input">Branch</label>
              @isset($branches)
                <select class="form-control" id="branch-input" onchange="hallsSelectHandler(this)">
                  <option hidden disabled selected value> -- Choose a branch -- </option>
                  @foreach ($branches as $branch)
                    <option value="{{ $branch['id'] }}">
                      {{ $branch['name'] }}
                    </option>
                  @endforeach
                </select>
              @else
                <select class="form-control" id="branch-input"> </select>
              @endisset
            </div>
            <div class="form-group col-md-6">
              <label for="hall-input"> Hall </label>
              <select class="form-control" name="hid" id="hall-input" disabled>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="date-input">Time slot date</label>
              <input class="form-control" type="date" name="date" id="date-input">
            </div>
            <div class="form-group col-md-6">
              <label for="time-input">Time slot time</label>
              <input class="form-control" type="time" name="time" id="time-input">
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Add time slot</button>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection
