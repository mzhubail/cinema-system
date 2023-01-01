@extends('layouts.master')

@section('title', 'Search movies')

@push('styles')
  <style>
    /* fixed width */
    #search-form,
    #search-form .list-group {
      width: 400px;
    }

    #search-form .list-group {
      z-index: 1000;
    }

    #search-form:focus-within .list-group {
      display: block !important;
    }
  </style>
@endpush

@push('scripts')
  <script src="assets/search.js"></script>
@endpush

@section('main')
  <h1 class="display-4 text-center text-md-left"> Search Movies </h1>

  <form id="search-form" class="mx-auto mr-md-0 ml-md-auto mt-5 mt-md-3">
    {{-- Search box --}}
    <div class="input-group">
      <input id="search-box" class="form-control" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </div>
    </div>

    {{-- Contains suggestions --}}
    <div class="list-group position-absolute d-none" id="suggestions-container">
    </div>
  </form>

  <hr class="my-4">

  {{-- Contains results --}}
  <x-movie-cards-container id="movies-container" />
@endsection
