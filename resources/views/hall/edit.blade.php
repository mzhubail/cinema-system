@extends('layouts.master')

@section('title', 'Add Branch')

@section('main')
  <form method="post" class="container" style="max-width: var(--breakpoint-sm);">
    @csrf
    <input type="hidden" name="id" value="{{ $hall->id }}">
    <div class="card">
      <h4 class="card-header">Edit Hall</h4>
      <div class="card-body">
        <div class="form-group">
          <label for="letter-input">Letter</label>
          <input type="text" class="form-control" name="letter" id="letter-input" value="{{ $hall->letter }}">
        </div>
        <div class="form-group">
          <label for="branch-input">Branch</label>
          <select class="form-control" id="branch-input" disabled>
              <option>
                {{ $hall->branch->name }}
              </option>
          </select>
        </div>
        <div class="d-flex justify-content-end">
          <input class="btn btn-primary" type="submit" value="Edit hall">
        </div>
      </div>
    </div>
  </form>
@endsection
