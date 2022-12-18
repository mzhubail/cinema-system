@extends('layouts.master')

@section('title', 'Choose time')

@push('styles')
  <style>
    /* .tab-content a {
                      margin-left: 4px;
                    }

                    .tab-content a.disabled {
                      color: gray;
                    } */
  </style>
@endpush

@section('main')
  {{-- <div class="container" style="max-width: var(--breakpoint-md);"> --}}
  @php
    function format_date($date)
    {
        return Str::of($date)
            ->before(',')
            ->snake();
    }
  @endphp

  <div class="container">
    <div class="card">
      {{-- <h4 class="card-header"> Choose time </h4> --}}
      <div class="card-body">
        {{-- {{ print_r($time_slots, true) }} --}}
        <ul class="nav nav-pills flex-column flex-md-row justify-content-center" id="myTab" role="tablist">

          @foreach (array_keys($time_slots) as $date)
            @php $f_date = format_date($date) @endphp
            <li class="nav-item text-md-center" role="presentation">
              <a @class(['nav-link', 'active' => $loop->first]) id="{{ "$f_date-tab" }}" data-toggle="tab"
                data-target="{{ "#$f_date-content" }}" type="button" role="tab" aria-controls="home"
                aria-selected="true">
                {{ $date }}
              </a>
            </li>
          @endforeach
          {{-- <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button"
              role="tab" aria-controls="profile" aria-selected="false">Profile</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button"
              role="tab" aria-controls="contact" aria-selected="false">Contact</button>
          </li> --}}

        </ul>

        <div class="tab-content mt-4">
          @foreach ($time_slots as $date => $branches)
            @php $f_date = format_date($date) @endphp
            <div @class(['tab-pane', 'fade', 'show active' => $loop->first]) id="{{ "$f_date-content" }}" role="tabpanel"
              aria-labelledby="{{ "$f_date-tab" }}">

              <div class="row d-none d-md-flex font-weight-bold mb-3">
                <div class="col-3">Branch</div>
                <div class="col">Time</div>
              </div>

              @foreach ($branches as $branch => $timings)
                <div class="row mb-3">
                  <div class="col-12 col-md-3  mb-2 mb-md-0  d-flex align-items-center">
                    {{ $branch }}
                  </div>
                  <div class="col">
                    {{-- @foreach ($timings as ['time' => $time, 'time_slot_id' => $time_slot_id])
                      <a @class(['disabled' => $time->isPast()]) href="/choose_seats?tsid={{ $time_slot_id }}">
                        {{ $time->toTimeString() }}
                      </a>
                    @endforeach --}}

                    {{-- TODO: Make button groups responsive --}}
                    <div class="btn-group btn-group-cond-vertical" role="group">
                      @foreach ($timings as ['time' => $time, 'time_slot_id' => $time_slot_id])
                        <a @class(['btn', 'btn-secondary', 'disabled' => $time->isPast()]) type="button" href="/choose_seats?tsid={{ $time_slot_id }}">
                          {{ $time->toTimeString() }}
                        </a>
                      @endforeach
                    </div>
                  </div>
                </div>
                {{-- {{ $branch . ' : ' . print_r($v, true) }}
                <br> --}}
              @endforeach
            </div>
          @endforeach
          {{-- <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
          <div class="tab-pane" id="messages" role="tabpanel" aria-labelledby="messages-tab">...</div>
          <div class="tab-pane" id="settings" role="tabpanel" aria-labelledby="settings-tab">...</div> --}}
        </div>
      </div>
    </div>
  </div>

@endsection
