@extends('layouts.master')

@section('title', 'Home')

@section('main')
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
  <x-movie-cards-container>
    <x-movie-card />
    <x-movie-card />
    <x-movie-card />
    <x-movie-card />
    <x-movie-card />
  </x-movie-cards-container>
@endsection

@push('styles')
  <link rel="stylesheet" type="text/css" href="assets/glider.css">
@endpush
