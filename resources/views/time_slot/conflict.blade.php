@extends('layouts.master')

@section('title', 'Time Slot Conflicts')

@push('styles')
  <style>
    tr:nth-of-type(2n) td {
      border-bottom: 3px solid #dee2e6;
    }
  </style>
@endpush

@section('main')
  @empty($conflicts)
    <h4>No Time Slot conflicts where found</h4>
    <span class="mb-3 float-right">
      Date: {{ now()->toDateString() }} <br>
      Time: {{ now()->format('H:i') }}
    </span>
  @else
    <div class="card">
      <h4 class="card-header"> Time Slot Conflicts </h4>
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
                  {{-- <th> Hall ID </th>
                  @foreach (range(1, 2) as $i)
                    <th> Time Slot ID </th>
                    <th> Movie Title </th>
                    <th> Start Time </th>
                    <th> Duration </th>
                    <th> End Time </th>
                  @endforeach --}}
                  <th> Hall ID </th>
                  <th> Time Slot ID </th>
                  <th> Movie Title </th>
                  <th> Start Time </th>
                  <th> Duration </th>
                  <th> End Time </th>
                </tr>
              </thead>
              <tbody>
                @foreach ($conflicts as $conflict)
                  <tr>
                    {{-- WARNING: Beware that proper date formatting
                      is not usedland we instead are relying on a
                      proper format to be already passed --}}
                    <td> {{ $conflict->hall_id }} </td>
                    <td> {{ $conflict->id_a }} </td>
                    <td> {{ $conflict->title_a }} </td>
                    <td> {{ $conflict->start_time_a }} </td>
                    <td> {{ $conflict->duration_a }} </td>
                    <td> {{ $conflict->end_time_a }} </td>
                  </tr>
                  <tr>
                    <td> {{ $conflict->hall_id }} </td>
                    <td> {{ $conflict->id_b }} </td>
                    <td> {{ $conflict->title_b }} </td>
                    <td> {{ $conflict->start_time_b }} </td>
                    <td> {{ $conflict->duration_b }} </td>
                    <td> {{ $conflict->end_time_b }} </td>
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
