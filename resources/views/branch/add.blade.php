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
          <input class="form-control" type="text" name="name" id="name-input">
        </div>
        <div class="form-group">
          <label for="address-input">Address:</label>
          <input class="form-control" type="text" name="addr" id="address-input">
        </div>
        <div class="d-flex justify-content-end">
          <input class="btn btn-primary" type="submit" value="Add branch">
        </div>
      </div>
    </div>
  </form>
@endsection
