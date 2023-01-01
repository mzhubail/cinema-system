@extends('layouts.master')

@section('title', 'Browse Bookings')

@section('main')
  <div class="card">
    <h4 class="card-header">Browse Bookings</h4>
    <div class="card-body">
      <div class="form-group row">
        <label for="movie-input" class="col-form-label col-md-3"> Customer </label>
        <div class="col-md-9">
          <select class="form-control" id="movie-input" onchange="bookingsByCustomerHandler(this)">
            <option hidden disabled selected value> -- Choose a customer -- </option>
            @foreach ($customers as $customer)
              <option value="{{ $customer->id }}">
                {{ $customer->email }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
      <div id="ts-table" class="table-responsive" style="display: none;"></div>
    </div>
  </div>
@endsection

