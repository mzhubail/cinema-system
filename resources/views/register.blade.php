@extends('layouts.master')

@section('title', 'Register')

@section('main')
  <form method="post" class="container" style="max-width: var(--breakpoint-md);">
    @csrf
    <div class="card">
      <h4 class="card-header">Register</h4>
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="fName-input">First name</label>
            <x-input name="fName" />
          </div>
          <div class="form-group col-md-6">
            <label for="lName-input">Last name</label>
            <x-input name="lName" />
          </div>
        </div>
        <div class="form-group">
          <label for="email-input">E-mail</label>
          <x-input type="email" name="email" autocomplete="off" />
        </div>
        <div class="form-group">
          <label for="birthday-input">Birthday</label>
          <x-input type="date" name="birthday" />
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="password-input">Password</label>
            <x-input type="password" name="password" />
          </div>
          <div class="form-group col-md-6">
            <label for="password_confirmation-input">Confirm password</label>
            <x-input type="password" name="password_confirmation" />
          </div>
        </div>
        {{-- <div class="form-group">
          <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" id="c99">
            <label class="custom-control-label" for="c99">
              Remember me
            </label>
          </div>
        </div> --}}
        <div class="form-group">Already have an account? <a href="./login">Log in</a> </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary"> Register </button>
        </div>
      </div>
    </div>
  </form>

@endsection
