@extends('layouts.master')

@section('title', 'Add Branch')

@section('main')
  <form method="post" class="container" style="max-width: var(--breakpoint-sm);">
    @csrf
    <div class="card">
      <h4 class="card-header">Add branch</h4>
      <div class="card-body">
        <div class="form-group">
          <label for="name-input">Name:</label>
          <x-input name="name" />
        </div>
        <div class="form-group">
          <label for="address-input">Address:</label>
          <x-input name="address" />
        </div>
        <div class="d-flex justify-content-end">
          <input class="btn btn-primary" type="submit" value="Add branch">
        </div>
      </div>
    </div>
  </form>
@endsection
