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
              <x-input name="title" />
            </div>
            <div class="form-group col-md-6">
              <label for="release_year-input">Release year</label>
              <x-input type="number" name="release_year" />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="duration-input">Duration</label>
              <x-input type="time" max="03:00" min="00:00" name="duration" />
            </div>
            <div class="form-group col-md-6">
              <label for="lang-input">Language</label>
              <x-select name="lang" :values="[
                  'en' => 'English',
                  'ar' => 'Arabic',
                  'Hu' => 'Hindi',
              ]" />
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="rating-input">Rating</label>
              <x-input type="number" max="10.0" min="0.0" step="0.1" name="rating" />
            </div>

            <div class="form-group col-md-6">
              <label for="genre-input">Genre</label>
              <x-select name="genre" :values="collect(config('constants.genres'))->mapWithKeys(fn($item, $key) => [$item => ucfirst($item)])" />
            </div>
          </div>
          <div class="form-group">
            <label for="movie-desc">Description</label>
            <textarea class="form-control" name="desc" id="movie-desc" cols="30" rows="10">
@if (old('desc') !== null){{ old('desc') }}@endif
</textarea>
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
