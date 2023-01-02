@extends('layouts.master')

@section('title', 'Not Found')

@section('main')

  <div class="row align-items-center mb-3 text-center">
    <h1 class="display-2 col-md-4">
      404
    </h1>
    <h1 class="display-4 col text-md-left">
      Not found
    </h1>
  </div>

    {{-- <h1 class="display-4">
      404 <br>
      Not found
    </h1> --}}

  <div class="mb-2">
    That's an error.
  </div>
  {{-- The requested URL "{{ url()->current() }}" was not found on this server. That's all we know. --}}
  The requested URL "{{ $_SERVER['REQUEST_URI'] }}" was not found on this server. That's all we know.


@endsection
