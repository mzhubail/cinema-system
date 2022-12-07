@extends('layouts.master')

@section('title', '')

@section('main')
  @include('components.seats_picker', ['seats' => $seats])
@endsection
