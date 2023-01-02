@extends('layouts.master')

@section('title', 'Not Foung')

@section('main')

  <h2 class="col text-center">
    You have to log in to continue
  </h2>

  <hr class="my-5">

  <div class="d-flex justify-content-center">
    <a href="/login" class="btn-lg btn-primary mr-4"> Login </a>
    <a href="/register" class="btn-lg btn-outline-primary"> Register </a>
  </div>

@endsection
