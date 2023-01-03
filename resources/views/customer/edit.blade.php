@extends('layouts.master')

@section('title', 'Edit Profile')

@section('main')
  <form method="post" class="container" style="max-width: var(--breakpoint-md);">
    @csrf
    <div class="card">
      <h4 class="card-header"> Update Profile </h4>
      <div class="card-body">
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="fName-input">First name</label>
            <x-input name="fName" :value="$customer->fName" />
          </div>
          <div class="form-group col-md-6">
            <label for="lName-input">Last name</label>
            <x-input name="lName" :value="$customer->lName" />
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="email-input">E-mail</label>
            <x-input type="email" name="email" :value="$customer->email" autocomplete="off" />
          </div>
          <div class="form-group col-md-6">
            <label for="birthday-input">Birthday</label>
            <x-input type="date" name="birthday" :value="$customer->birthday" />
          </div>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary"> Update profile </button>
        </div>
      </div>
    </div>
  </form>


@endsection
