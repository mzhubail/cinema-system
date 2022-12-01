@extends('layouts.master')

@section('title', 'Add Branch')

@section('main')
  <form method="post" class="container" style="max-width: var(--breakpoint-sm);">
    @csrf
    <div class="card">
      <h4 class="card-header">Add Hall</h4>
      <div class="card-body">
        <div class="form-group">
          <label for="letter-input">Letter</label>
          <input type="text" class="form-control" name="letter" id="letter-input">
        </div>
        <div class="form-group">
          <label for="branch-input">Branch</label>
          <select class="form-control" name="branch_id" id="branch-input">
            @foreach ($branches as $branch)
              <option value="{{ $branch['id'] }}">
                {{ $branch['name'] }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="d-flex justify-content-end">
          <input class="btn btn-primary" type="submit" value="Add hall">
        </div>
      </div>
    </div>
  </form>
@endsection
