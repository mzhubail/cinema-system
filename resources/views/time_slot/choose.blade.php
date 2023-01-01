@extends('layouts.master')

@section('title', 'Choose time')

@section('main')
  @php
    /** Helper function to convert date into a string that can be used in html id
     * attribute
     */
    function format_date($date)
    {
        return Str::of($date)
            ->before(',')
            ->snake();
    }
  @endphp

  <div class="container">
    @empty($time_slots)
      Unavailable
    @else
      <div class="card">
        <h4 class="card-header">Choose Time</h4>
        <div class="card-body">
          <ul class="nav nav-pills flex-column flex-md-row justify-content-center" id="myTab" role="tablist">
            {{-- Each date has its own tab button --}}
            @foreach (array_keys($time_slots) as $date)
              @php $f_date = format_date($date) @endphp
              <li class="nav-item text-md-center mb-2" role="presentation">
                <a @class(['nav-link', 'active' => $loop->first]) id="{{ "$f_date-tab" }}" data-toggle="tab"
                  data-target="{{ "#$f_date-content" }}" type="button" role="tab" aria-controls="home"
                  aria-selected="true">
                  {{ $date }}
                </a>
              </li>
            @endforeach
          </ul>

          <div class="tab-content mt-4">
            {{-- Each date has its own tab-pane --}}
            @foreach ($time_slots as $date => $branches)
              @php $f_date = format_date($date) @endphp
              <div @class(['tab-pane', 'fade', 'show active' => $loop->first]) id="{{ "$f_date-content" }}" role="tabpanel"
                aria-labelledby="{{ "$f_date-tab" }}">

                {{-- Header Row --}}
                <div class="row d-none d-md-flex font-weight-bold mb-3">
                  <div class="col-3">Branch</div>
                  <div class="col">Time</div>
                </div>

                {{-- Each branch has its own row --}}
                @foreach ($branches as $branch => $timings)
                  <div class="row mb-3">
                    <div class="col-12 col-md-3  mb-2 mb-md-0  d-flex align-items-center">
                      <span class="d-md-none text-muted"> Branch: &nbsp; </span>
                      {{ $branch }}
                    </div>
                    <div class="col">
                      {{-- TODO: Make button groups responsive --}}
                      <div class="btn-group btn-group-cond-vertical" role="group">
                        @foreach ($timings as ['time' => $time, 'time_slot_id' => $time_slot_id])
                          <a @class(['btn', 'btn-secondary', 'disabled' => $time->isPast()]) type="button" href="/choose_seats?tsid={{ $time_slot_id }}">
                            {{ $time->format('H:i') }}
                          </a>
                        @endforeach
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  @endempty

@endsection
