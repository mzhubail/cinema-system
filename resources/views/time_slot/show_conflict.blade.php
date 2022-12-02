@extends('layouts.master')

@section('title', 'Browse Branches')

@section('style')
  <style>
    tr :nth-child(1) {
      border-right: 2px solid #dee2e6;
    }

    tr :nth-child(5) {
      border-right: 2px solid #dee2e6;
    }
  </style>
@endsection

@section('main')
  @isset($conflicts)
    <div class="card">
      <h4 class="card-header"> Time Slot Conflicts </h4>
      <div class="card-body">
        <div class="container">
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th> Hall ID </th>
                  @foreach (range(1, 2) as $i)
                    <th> Time Slot ID </th>
                    <th> Movie Title </th>
                    <th> Start Time </th>
                    <th> End Time </th>
                  @endforeach
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
                    <td> {{ $conflict->end_time_a }} </td>
                    <td> {{ $conflict->id_b }} </td>
                    <td> {{ $conflict->title_b }} </td>
                    <td> {{ $conflict->start_time_b }} </td>
                    <td> {{ $conflict->end_time_b }} </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  @else
    <h4>No conflicts where found</h4>
  @endisset
@endsection
