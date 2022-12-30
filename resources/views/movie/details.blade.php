@extends('layouts.master')

@section('title', 'Movie Details')

@section('main')

  <div class="row">
    <div class="col-md-3 mb-5 mb-md-0">
      <img class="rounded-lg" src="{{ asset($movie->img_path) }}" style="width: 100%;" alt="">
    </div>
    <div class="col">
      <h2 class="display-4 text-capitarize text-center mb-3" style="font-size: 3rem;"> {{ $movie->title }} </h2>
      <div class="text-muted text-center mb-4 row">
        <p class="col-4">
          {{-- Globe Icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-globe-central-south-asia" viewBox="0 0 16 16">
            <path
              d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0ZM4.882 1.731a.482.482 0 0 0 .14.291.487.487 0 0 1-.126.78l-.291.146a.721.721 0 0 0-.188.135l-.48.48a1 1 0 0 1-1.023.242l-.02-.007a.996.996 0 0 0-.462-.04 7.03 7.03 0 0 1 2.45-2.027Zm-3 9.674.86-.216a1 1 0 0 0 .758-.97v-.184a1 1 0 0 1 .445-.832l.04-.026a1 1 0 0 0 .152-1.54L3.121 6.621a.414.414 0 0 1 .542-.624l1.09.818a.5.5 0 0 0 .523.047.5.5 0 0 1 .724.447v.455a.78.78 0 0 0 .131.433l.795 1.192a1 1 0 0 1 .116.238l.73 2.19a1 1 0 0 0 .949.683h.058a1 1 0 0 0 .949-.684l.73-2.189a1 1 0 0 1 .116-.238l.791-1.187A.454.454 0 0 1 11.743 8c.16 0 .306.084.392.218.557.875 1.63 2.282 2.365 2.282a.61.61 0 0 0 .04-.001 7.003 7.003 0 0 1-12.658.905Z" />
          </svg>
          {{ $movie->lang }}
        </p>
        <p class="col-4">
          {{-- Clock Icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-clock-fill" viewBox="0 0 16 16">
            <path
              d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71V3.5z" />
          </svg>
          {{ $formatted_duration }}
        </p>
        <p class="col-4">
          {{-- Calendar Icon --}}
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-calendar-fill" viewBox="0 0 16 16">
            <path
              d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5h16V4H0V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5z" />
          </svg>
          {{-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar"
            viewBox="0 0 16 16">
            <path
              d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
          </svg> --}}
          {{ $movie->release_year }}
        </p>
      </div>

      <div class="px-5">
        <p class="lead">
          {{ $movie->desc }}
        </p>

        <div class="d-flex align-items-center my-3">
          <x-rating rating="9" />

          @if (session()->has('isAdmin') && !session('isAdmin'))
            <a class="ml-auto" href="/choose_time_slot?mid={{ $movie->id }}">
              <button type="button" class="btn-lg btn-primary">
                Book
              </button>
            </a>
          @endif
        </div>

      </div>
    </div>
  </div>

@endsection
