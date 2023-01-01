@extends('layouts.master')

@section('title', 'Search movies')

@push('styles')
  <style>
    #search-form,
    #search-form .list-group {
      width: 400px;
    }

    /* .input-group:focus-within + div {
                    display: block;
                  } */
    #search-form .list-group {
      z-index: 1000;
    }

    #search-form:focus-within .list-group {
      /* color: goldenrod;
                  border-radius: 100%; */
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
    <div class="input-group">
      <input id="search-box" class="form-control" placeholder="Search" aria-label="Search">
      <div class="input-group-append">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
      </div>
    </div>
    <div class="list-group position-absolute d-none" id="suggestions-container">
      {{-- <button type="button" class="p-2 list-group-item list-group-item-action">A second item</button>
      <button type="button" class="p-2 list-group-item list-group-item-action">A third button item</button>
      <button type="button" class="p-2 list-group-item list-group-item-action">A fourth button item</button> --}}

      {{-- <a href="#" class="list-group-item list-group-item-action">A second link item</a>
      <a href="#" class="list-group-item list-group-item-action">A third link item</a>
      <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
      <a class="list-group-item list-group-item-action disabled">A disabled link item</a> --}}
    </div>
  </form>

  <hr class="my-4">
  {{-- <div>
    this
  </div> --}}
  <x-movie-cards-container id="movies-container" />
@endsection
