@extends('layouts.master')

@section('title', 'Booking conflict')

@push('styles')
  <style>
    tr:nth-of-type(2n) td {
      border-bottom: 3px solid #dee2e6;
    }
  </style>
@endpush

@section('main')
  @empty($conflicts)
    <h4>No seat conflicts where found</h4>
    <span class="mb-3 float-right">
      Date: {{ now()->toDateString() }} <br>
      Time: {{ now()->format('H:i') }}
    </span>
  @else
    <div class="card">
      <h4 class="card-header"> Booking Conflicts </h4>
      <div class="card-body">
        <div class="container">
          <span class="mb-3 float-right">
            Date: {{ now()->toDateString() }} <br>
            Time: {{ now()->format('H:i') }}
          </span>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th> Time Slot ID </th>
                  <th> Booking ID </th>
                  <th> Seat ID </th>
                  <th> Seat Code </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($conflicts as $conflict)
                  @php
                    $seat = chr($conflict->row_a + 65);
                    $seat .= sprintf('%02d', $conflict->column_a + 1);
                  @endphp
                  <tr>
                    <td> {{ $conflict->time_slot_id }} </td>
                    <td> {{ $conflict->booking_id_a }} </td>
                    <td> {{ $conflict->seat_id_a }} </td>
                    <td> {{ $seat }} </td>
                  </tr>
                  <tr>
                    <td> {{ $conflict->time_slot_id }} </td>
                    <td> {{ $conflict->booking_id_b }} </td>
                    <td> {{ $conflict->seat_id_b }} </td>
                    <td> {{ $seat }} </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  @endempty
@endsection
