@extends('layouts.master')

@section('title', 'Home')

@section('main')
  Enter customer home code here

  <br>
  <br>
  <br>

  <x-movie-cards-container>
    <x-movie-card />
    <x-movie-card />
    <x-movie-card />
    <x-movie-card />
    <x-movie-card />
  </x-movie-cards-container>
@endsection
