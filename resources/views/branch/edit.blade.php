@extends('layouts.master')

@section('title', 'Add Branch')

@section('main')
  <form method="post" class="container" style="max-width: var(--breakpoint-sm);">
    @csrf
    <input type="hidden" name="branch" value="{{ $branch->id }}">
    <div class="card">
      <h4 class="card-header">Edit branch</h4>
      <div class="card-body">
        <div class="form-group">
          <label for="name-input">Name:</label>
          <x-input name="name" :value="$branch->name" />
        </div>
        <div class="form-group">
          <label for="address-input">Address:</label>
          <x-input name="address" :value="$branch->addr" />
        </div>
        <div class="d-flex justify-content-end">
          <input class="btn btn-primary" type="submit" value="Edit branch">
        </div>
      </div>
    </div>
  </form>
@endsection
