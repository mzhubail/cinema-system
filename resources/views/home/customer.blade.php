@extends('layouts.master', ['without_container' => true])

@section('title', 'Home')

@section('main')
  <div class="jumbotron jumbotron-fluid shadow">
    <div class="container">
      <x-glider>
        <x-movie-card />
        <x-movie-card />
        <x-movie-card />
        <x-movie-card />
        <x-movie-card />
        <x-movie-card />
        <x-movie-card />
        <x-movie-card />
      </x-glider>
    </div>
  </div>

  <main class="container py-5">
    <h1 class="display-4">Browse Movies</h1>
    <hr class="my-5">

    <x-movie-cards-container :movies="$movies" />
  </main>
@endsection

@push('styles')
  <link rel="stylesheet" type="text/css" href="assets/glider.css">
@endpush
