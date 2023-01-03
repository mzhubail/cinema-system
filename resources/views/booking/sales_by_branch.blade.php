@extends('layouts.master')

@section('title', 'Sales By Branch')

@push('styles')
  <style>
    tr :nth-child(4) {
      text-align: right;
      padding-right: 5rem;
    }
  </style>
@endpush

@section('main')
  @empty($branches)
    <h4>No sales currently available </h4>
    <span class="mb-3 float-right">
      Date: {{ now()->toDateString() }} <br>
      Time: {{ now()->format('H:i') }}
    </span>
  @else
    <div class="card">
      <h4 class="card-header"> Sales By Branch </h4>
      <div class="card-body">
        <div class="container">
          <span class="mb-3 float-right">
            Date: {{ now()->toDateString() }} <br>
            Time: {{ now()->format('H:i') }}
          </span>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th> Branch ID </th>
                  <th> Branch Name </th>
                  <th> Total Bookings </th>
                  <th> Total Profit </th>
                </tr>
              </thead>
              <tbody>
                @php
                  $total_bookings = 0;
                  $total_profit = 0;
                @endphp
                @foreach ($branches as $branch)
                  @php
                    $total_bookings += $branch->bookings_count;
                    $total_profit += $branch->total_profit;
                  @endphp
                  <tr>
                    <td> {{ $branch->branch_id }} </td>
                    <td> {{ $branch->branch_name }} </td>
                    <td> {{ $branch->bookings_count }} </td>
                    <td> {{ sprintf('%.3f', $branch->total_profit) }} </td>
                  </tr>
                @endforeach
                <tr class="font-weight-bold">
                  <th> Total </th>
                  <td>  </td>
                  <td> {{ $total_bookings }} </td>
                  <td> {{ sprintf('%.3f', $total_profit) }} </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  @endempty
@endsection
