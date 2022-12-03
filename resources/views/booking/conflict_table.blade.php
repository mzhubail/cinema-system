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

@section('main')
  @empty($conflicts)
    <div class="card">
      <h4 class="card-header"> Booking Conflicts </h4>
      <div class="card-body">
        <div class="container">
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr class="custom-alignment">
                  <th rowspan="2"> Time Slot ID </th>
                  <th rowspan="2"> Row# </th>
                  <th colspan="4"> Booking 1 </th>
                  <th colspan="4"> Booking 2 </th>
                </tr>
                <tr>
                  @foreach (range(1, 2) as $i)
                    <th> Booking ID </th>
                    <th> Customer ID </th>
                    <th> Seats start </th>
                    <th> Seats end </th>
                  @endforeach
                </tr>
              </thead>
              <tbody>
                @foreach ($conflicts as $conflict)
                  <tr>
                    <td> {{ $conflict->time_slot_id }} </td>
                    <td> {{ $conflict->row }} </td>
                    <td> {{ $conflict->id_a }} </td>
                    <td> {{ $conflict->customer_a }} </td>
                    <td> {{ $conflict->seats_start_a }} </td>
                    <td> {{ $conflict->seats_end_a }} </td>
                    <td> {{ $conflict->id_b }} </td>
                    <td> {{ $conflict->customer_b }} </td>
                    <td> {{ $conflict->seats_start_b }} </td>
                    <td> {{ $conflict->seats_end_b }} </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  @else
    <h4>No booking conflicts where found</h4>
  @endempty
@endsection

