@extends('layouts.master')

@section('title', 'Comming Soon')

@section('main')
  <h1 class="display-4 text-center text-md-left"> Coming soon </h1>
  <hr class="my-4">
  <x-movie-cards-container :movies="$movies" />
@endsection
