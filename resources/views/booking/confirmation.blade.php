@extends('layouts.master')

@section('title', 'Confirm Booking')

@section('main')
  <form method="post" class="container" style="max-width: var(--breakpoint-sm);">
    @csrf
    <input type="hidden" name="payment_method" value="paypal">
    <div class="card">
      <h4 class="card-header">Booking Details</h4>
      <div class="card-body">
        {{-- <div class="row">
          <div class="col-12 col-md-3 text-md-muted"> Booking ID </div>
          <div class="col"> {{ $time_slot->movie->title }} </div>
        </div> --}}
        <div class="row">
          <div class="col-12 col-md-3 text-md-muted"> User ID </div>
          <div class="col"> {{ session('userId') }} </div>
        </div>
        <br>
        <div class="row">
          <div class="col-12 col-md-3 text-md-muted"> Movie Title </div>
          <div class="col"> {{ $time_slot->movie->title }} </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-3 text-md-muted"> Start time </div>
          <div class="col"> {{ $time_slot->start_time }} </div>
        </div>
        <div class="row">
          <div class="col-12 col-md-3 text-md-muted"> Duration </div>
          <div class="col"> {{ $time_slot->movie->duration }} </div>
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
          <div class="col-12 col-md-3 text-md-muted"> Seats </div>
          <div class="col"> {{ join(', ', $seats) }} </div>
        </div>
        <button type="submit" class="btn btn-primary float-right mt-4">
          Confirm booking
        </button>
      </div>
    </div>
  </form>
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
