@extends('layouts.master')

@section('title', 'Current Bookings')

@section('main')
  <form method="post" class="container">
    <div class="card">
      <h4 class="card-header"> Current Bookings </h4>
      <div class="card-body">
        <x-bookings-table :bookings="$bookings" />
      </div>
    </div>
  </form>
@endsection

