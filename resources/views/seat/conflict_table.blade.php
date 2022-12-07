@extends('layouts.master')

@section('title', 'Booking conflict')

@section('style')
  <style>
    .custom-alignment {
      text-align: center !important;
    }

    .custom-alignment th {
      vertical-align: middle !important;
    }
  </style>
@endsection

{{-- TODO: Consider a better format for table.  Display conflicting records one
  under the other instead of side by side --}}
@section('main')
  @empty($conflicts)
    <h4>No booking conflicts where found</h4>
  @else
    <div class="card">
      <h4 class="card-header"> Booking Conflicts </h4>
      <div class="card-body">
        <div class="container">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr class="custom-alignment">
                  <th> Time Slot ID </th>
                  <th> Booking ID </th>
                  <th> Seat ID </th>
                  <th> Row </th>
                  <th> Column </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($conflicts as $conflict)
                  <tr>
                    <td rowspan="2"> {{ $conflict->time_slot_id }} </td>
                    <td> {{ $conflict->booking_id_a }} </td>
                    <td> {{ $conflict->seat_id_a }} </td>
                    <td rowspan="2"> {{ $conflict->row_a }} </td>
                    <td rowspan="2"> {{ $conflict->column_a }} </td>
                  </tr>
                  <tr>
                    <td> {{ $conflict->booking_id_b }} </td>
                    <td> {{ $conflict->seat_id_b }} </td>
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
