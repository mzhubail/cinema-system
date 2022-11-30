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
            <label for="inputEmail_">First name</label>
            <input type="text" class="form-control" id="inputEmail_" name="fName">
          </div>
          <div class="form-group col-md-6">
            <label for="inputPassword4">Last name</label>
            <input type="text" class="form-control" id="inputPassword4" name="lName">
          </div>
        </div>
        <div class="form-group">
          <label for="email-input">E-mail</label>
          <input class="form-control" type="email" id="email-input" name="email" autocomplete="off">
        </div>
        <div class="form-group">
          <label for="bday-input">Birthday</label>
          <input class="form-control" type="date" id="bday-input" name="birthday">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="pass-input">Password</label>
            <input type="password" class="form-control" id="pass-input" name="password">
          </div>
          <div class="form-group col-md-6">
            <label for="pass-conf">Confirm password</label>
            <input type="password" class="form-control" id="pass-conf">
          </div>
        </div>
        <div class="form-group">
          <div class="custom-control custom-checkbox">
            <input class="custom-control-input" type="checkbox" id="c99">
            <label class="custom-control-label" for="c99">
              Remember me
            </label>
          </div>
        </div>
        <div class="form-group">Already have an account? <a href="./login.php">Log in</a> </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Sign in</button>
        </div>
      </div>
    </div>
  </form>

@endsection
