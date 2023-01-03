@extends('layouts.master')

@section('title', 'Booking details')

@section('main')
  <div class="card mx-auto" style="max-width: var(--breakpoint-sm);">
    <h4 class="card-header">Booking Details</h4>
    <div class="card-body">
      <div class="row">
          <div class="col-12 col-md-3 text-md-muted"> Booking ID </div>
          <div class="col"> {{ $booking->id }} </div>
        </div>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> Customer ID </div>
        <div class="col"> {{ $booking->customer->id }} </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> Email </div>
        <div class="col"> {{ $booking->customer->email }} </div>
      </div>
      <br>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> Movie Title </div>
        <div class="col"> {{ $booking->movie->title }} </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> Start time </div>
        <div class="col"> {{ (new Illuminate\Support\Carbon($booking->time_slot->start_time))->format('Y-m-d H:i') }} </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> Duration </div>
        <div class="col"> {{ \App\Models\Movie::minutesToDuration($booking->movie->duration) }} </div>
      </div>
      <br>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> Branch name </div>
        <div class="col"> {{ $booking->branch->name }} </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> Hall </div>
        <div class="col"> {{ $booking->hall->letter }} </div>
      </div>
      {{-- price: {{ $price }} --}}
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> No of seats </div>
        <div class="col"> {{ $seats->count() }} </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted text-wrap"> Seats </div>
        <div class="col"> {{ $seats->join(', ') }} </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted text-wrap"> Price </div>
        <div class="col"> {{ sprintf('%.3f', $booking->price) }} BD </div>
      </div>
      <br>
      
      Date: {{ now()->toDateString() }} <br>
      Time: {{ now()->format('H:i') }}
    </div>
  </div>
@endsection

@push('styles')
  <style>
    @media (max-width: 768px) {
      .text-md-muted {
        color: #6c757d !important;
      }
    }
  </style>
@endpush
