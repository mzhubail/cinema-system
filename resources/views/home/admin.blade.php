@extends('layouts.master')

@section('title', 'Home')

{{-- @push('styles')
  <style>
    * {
      box-sizing: border-box;
    }

    /* Create two equal columns that floats next to each other */
    .column {
      float: left;
      width: 50%;
      padding: 10px;
      height: 300px;
      /* Should be removed. Only for demonstration */
    }

    .left {
      width: 25%;
    }

    .right {
      width: 75%;
    }

    /* Clear floats after the columns */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }
  </style>
@endpush --}}

@section('main')
  <div class="row">
    <div class="col-md-4">
      <h3 class="mt-3">Branches</h3>
      <a class="text-decoration-none" href="/browse_branches"> Browse Branches </a> <br>
      <a class="text-decoration-none" href="/add_branch"> Add Branch </a>

      <h3 class="mt-3">Halls</h3>
      <a class="text-decoration-none" href="/browse_halls"> Browse Halls </a>
      <br>
      <a class="text-decoration-none" href="/add_hall"> Add Hall </a>

    </div>

    <div class="col-md-4">
      <h3 class="mt-3">Movies</h3>
      <a class="text-decoration-none" href="/browse_movies"> Browse Movies </a>
      <br>
      <a class="text-decoration-none" href="/add_movie"> Add Movie </a>

      <h3 class="mt-3">Seats</h3>
      <a class="text-decoration-none" href="/browse_seats"> Show Seats </a>
      <br>
      <a class="text-decoration-none" href="/show_seat_conflicts"> Show Seat conflicts </a>
    </div>

    <div class="col-md-4">
      <h3 class="mt-3">Booking</h3>
      <a class="text-decoration-none" href="/browse_bookings_by_customer"> Browse Bookings by customer </a>
      <br>
      <a class="text-decoration-none" href="/browse_bookings_by_time_slot"> Browse Bookings by time slot </a>

      <h3 class="mt-3">Time Slots</h3>
      <a class="text-decoration-none" href="/browse_time_slots"> Browse Time Slots </a>
      <br>
      <a class="text-decoration-none" href="/add_time_slot"> Add Time Slot </a>
      <br>
      <a class="text-decoration-none" href="/show_time_conflicts"> Show Time Slot conflicts </a>
    </div>
  </div>

@endsection
