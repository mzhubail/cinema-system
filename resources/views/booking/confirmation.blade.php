@extends('layouts.master')

@section('title', 'Confirm Booking')

@section('main')
  <form method="POST" class="card mx-auto" style="max-width: var(--breakpoint-sm);">
    @csrf
    <h4 class="card-header">Booking Details</h4>
    <div class="card-body">
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> Customer ID </div>
        <div class="col"> {{ session('userId') }} </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> Email </div>
        <div class="col"> {{ session('customer')->email }} </div>
      </div>
      <br>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> Movie Title </div>
        <div class="col"> {{ $time_slot->movie->title }} </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> Start time </div>
        <div class="col"> {{ (new Illuminate\Support\Carbon($time_slot->start_time))->format('Y-m-d H:i') }} </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> Duration </div>
        <div class="col"> {{ \App\Models\Movie::minutesToDuration($time_slot->movie->duration) }} </div>
      </div>
      <br>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> Branch name </div>
        <div class="col"> {{ $time_slot->branch->name }} </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> Hall </div>
        <div class="col"> {{ $time_slot->hall->letter }} </div>
      </div>
      {{-- price: {{ $price }} --}}
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted"> No of seats </div>
        <div class="col"> {{ count($seats) }} </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted text-wrap"> Seats </div>
        <div class="col"> {{ join(', ', $seats) }} </div>
      </div>
      <div class="row">
        <div class="col-12 col-md-3 text-md-muted text-wrap"> Price </div>
        <div class="col"> {{ sprintf('%.3f', $price) }} BD </div>
      </div>
      <br>

      Date: {{ now()->toDateString() }} <br>
      Time: {{ now()->format('H:i') }}
      <button type="submit" class="btn btn-primary float-right mt-4">
        Proceed to payment
      </button>
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
