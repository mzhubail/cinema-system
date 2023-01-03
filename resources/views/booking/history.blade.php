@extends('layouts.master')

@section('title', 'Bookings History')

@section('main')
  <form method="post" class="container">
    <div class="card">
      <h4 class="card-header"> Bookings History </h4>
      <div class="card-body">
        <x-bookings-table :bookings="$bookings" />
      </div>
    </div>
  </form>
@endsection
