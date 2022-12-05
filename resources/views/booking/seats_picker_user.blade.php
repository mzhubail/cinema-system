@extends('layouts.master')

@section('title', '')

@section('style')
  <style>
    .seat {
      display: inline-block;
      background-color: grey;
      height: 18px;
      width: 14px;
      border-radius: 4px 4px 0 0;
      margin: 3px;
    }

    .seat.occupied {
      background-color: orangered;
    }

    .seat.selected {
      background-color: greenyellow;
    }

    .seat:nth-child(6),
    .seat:nth-child(9) {
      margin-right: 16px;
    }
  </style>
@endsection

@section('main')
  @php
    $states = ['', '', '', '', '', '', '', '', '', '', 'selected', 'occupied'];
  @endphp
  <div class="plane">
    {{-- TODO: add screen --}}

    <div id="rows-container">
      @foreach (range('A', 'E') as $i)
        <div>
          @foreach (range(1, 15) as $j)
            <div class="seat {{ $states[rand(0, count($states) - 1)] }}" id="{{ $i . sprintf('%02d', $j) }}"></div>
          @endforeach
        </div>
      @endforeach

    </div>

  </div>

  <div class="desc">

    <div class="available"></div>
    <h5>available</h5>
    <div class="Occupied"></div>
    <h5>Occupied</h5>
    <div class="selected"></div>
    <h5>selected</h5>

  </div>

  <div class="Price">
    <p>Total Price: </p>
    <input type="button" name="" value="Proceed">
  </div>

  <button class="btn btn-secondary" id="tmp">tmp</button>

@endsection

@section('script')
  <script src="assets/seats-picker.js"></script>
@endsection
