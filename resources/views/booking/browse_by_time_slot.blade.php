@extends('layouts.master')

@section('title', 'Browse Bookings')

@section('main')
  <div class="card">
    <h4 class="card-header">Browse Bookings</h4>
    <div class="card-body">
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="branch-input">Branch</label>
          @isset($branches)
            <select class="form-control" id="branch-input" onchange="hallsSelectHandler(this)">
              <option hidden disabled selected value> -- Choose a branch -- </option>
              @foreach ($branches as $branch)
                <option value="{{ $branch['id'] }}">
                  {{ $branch['name'] }}
                </option>
              @endforeach
            </select>
          @else
            <select class="form-control" id="branch-input"> </select>
          @endisset
        </div>
        <div class="form-group col-md-6">
          <label for="hall-input"> Hall </label>
          <select class="form-control" name="hid" id="hall-input" onchange="timeSlotsSelectHandler(this)" disabled>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="time-slot-input"> Time Slot</label>
        <select class="form-control" id="time-slot-input" onchange="bookingsByTimeSlotHandler(this)" disabled> </select>
      </div>
      <div id="ts-table" class="table-responsive" style="display: none;"></div>
    </div>
  </div>
@endsection

@push('scripts')
  {{-- <script src="assets/seats-picker.js"></script> --}}
@endpush
