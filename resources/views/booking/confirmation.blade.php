@extends('layouts.master')

@section('title', 'Confirm Booking')

@section('main')
  <form method="post" class="container" style="max-width: var(--breakpoint-sm);">
    @csrf
    <input type="hidden" name="payment_method" value="paypal">
    <div class="card">
      <h4 class="card-header">Booking Details</h4>
      <div class="card-body">
        <div class="row">
          <div class="col-3"> Booking ID </div>
          {{-- <div class="col"> {{ $time_slot->movie->title }} </div> --}}
        </div>
        <div class="row">
          <div class="col-3"> User ID </div>
          {{-- <div class="col"> {{ $time_slot->movie->title }} </div> --}}
        </div>
        <br>
        <div class="row">
          <div class="col-3"> Movie Title </div>
          <div class="col"> {{ $time_slot->movie->title }} </div>
        </div>
        <div class="row">
          <div class="col-3"> Start time </div>
          <div class="col"> {{ $time_slot->start_time }} </div>
        </div>
        <div class="row">
          <div class="col-3"> Duration </div>
          <div class="col"> {{ $time_slot->movie->duration }} </div>
        </div>
        <br>
        <div class="row">
          <div class="col-3"> Branch name </div>
          <div class="col"> {{ $time_slot->branch->name }} </div>
        </div>
        <div class="row">
          <div class="col-3"> Hall </div>
          <div class="col"> {{ $time_slot->hall->letter }} </div>
        </div>
        {{-- price: {{ $price }} --}}
        <div class="row">
          <div class="col-3"> No of seats </div>
          <div class="col"> {{ count($seats) }} </div>
        </div>
        <div class="row">
          <div class="col-3"> Seats </div>
          <div class="col"> {{ print_r($seats, true) }} </div>
        </div>
        <button type="submit" class="btn btn-primary float-right mt-4">
          Confirm booking
        </button>
      </div>
    </div>
  </form>
@endsection
