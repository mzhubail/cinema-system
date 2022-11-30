@extends('layouts.master')

@section('title', 'Add Movie')

@section('main')
  <div class="container" style="max-width: var(--breakpoint-md);">
    <form method="post" enctype="multipart/form-data">
      @csrf
      <div class="card">
        <h4 class="card-header">Add movie</h4>
        <div class="card-body">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="title-input">Title</label>
              <input class="form-control" type="text" name="title" id="title-input">
            </div>
            <div class="form-group col-md-6">
              <label for="rYear-input">Release year</label>
              <input class="form-control" type="number" name="releaseYear" id="rYear-input">
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="duration-input">Duration</label>
              <input class="form-control" type="time" max="03:00" min="00:00" name="duration"
                id="duration-input">
            </div>
            <div class="form-group col-md-6">
              <label for="lang-input">Language</label>
              <select class="form-control" name="lang" id="lang-input">
                <option value="en">English</option>
                <option value="ar">Arabic</option>
                <option value="Hu">Hindi</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="rating-input">Rating</label>
              <input class="form-control" type="number" max="10.0" min="0.0" step="0.1" name="rating"
                id="rating-input">
            </div>

            <div class="form-group col-md-6">
              <label for="genre-input">Genre</label>
              <select class="form-control" name="genre" id="genre-input">
                @foreach (config('constants.genres') as $genre)
                    <option value='{{ $genre }}'> {{ ucfirst($genre) }} </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="movie-desc">Description</label>
            <textarea class="form-control" name="desc" id="movie-desc" cols="30" rows="10"></textarea>
          </div>
          <div class="form-group custom-file mb-3">
            <!-- MAX_FILE_SIZE must precede the file input field -->
            <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
            <!-- Name of input element determines name in $_FILES array -->
            <input type="file" name="poster-img" class="custom-file-input" id="poster-input" required>
            <label class="custom-file-label" for="poster-input">Choose movie poster...</label>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Add movie</button>
          </div>
        </div>
      </div>
    </form>
  </div>
@endsection
