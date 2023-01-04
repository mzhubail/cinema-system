@extends('layouts.master')

@section('title', 'login')

@section('main')
  <form action="" method="post" class="container" style="max-width: var(--breakpoint-md);">
    @csrf
    <div class="card">
      <h4 class="card-header">Login</h4>
      <div class="card-body">
        <div class="form-group row">
          <label class="col-md-3 col-form-label" for="email-input">E-mail</label>
          <div class="col-md-9">
            <x-input type="email" name="email" autocomplete="off" />
          </div>
        </div>
        <div class="form-group row">
          <label class="col-md-3 col-form-label" for="password-input">Password</label>
          <div class="col-md-9">
            <x-input type="password" name="password" />
          </div>
        </div>
        <div class="form-group">Don't have an account yet? <a href="./register"> Register </a> </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary"> Log in </button>
        </div>
      </div>
    </div>
  </form>

@endsection
