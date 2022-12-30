@extends('layouts.master')

@section('title', 'New Arrival')

@section('main')
  <h1 class="display-4 text-center text-md-left"> New Arrival </h1>
  <hr class="my-4">
  <x-movie-cards-container :movies="$movies" />
@endsection

