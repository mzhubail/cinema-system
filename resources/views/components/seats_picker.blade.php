@push('styles')
  <style>
    /* TODO: make responsive */
    .seat-row>div {
      display: inline-block;
      height: 26px;
      width: 22px;
      margin: 5px;
    }

    .seat {
      background-color: grey;
      border-radius: 20% 20% 0 0;

      transition: background-color 200ms ease,
        box-shadow 300ms ease;
    }

    .seat-row {
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;

      text-align: center;

      font-weight: bold;
      color: gray;
    }

    .seat.occupied {
      background-color: orangered;
    }

    .seat.selected {
      background-color: greenyellow;
      box-shadow: 0px 0px 15px greenyellow;
    }

    .seat:not(.selected):not(.occupied):hover {
      box-shadow: 0px 0px 20px gray;
    }

    .seat-row>div:nth-child(7),
    .seat-row>div:nth-child(10) {
      margin-right: 16px;
    }
  </style>
@endpush

@push('scripts')
  <script>
    seats = {{ Illuminate\Support\Js::from($seats) }};
  </script>
  <script src="assets/seats-picker.js"></script>
@endpush


@php
  $states = ['', '', '', '', '', '', '', '', '', '', 'selected', 'occupied'];
@endphp
<div class="plane">
  {{-- TODO: add screen --}}
  <br>

  <div id="rows-container">
    <div class="seat-row">
      <div></div>
      @foreach (range(1, 15) as $j)
        <div> {{ $j }} </div>
      @endforeach
    </div>

    @foreach (range('A', 'E') as $i)
      <div class="seat-row">
        <div> {{ $i }} </div>
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
