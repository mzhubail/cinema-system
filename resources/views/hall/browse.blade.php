@extends('layouts.master')

@section('title', 'Browse Branches')

@section('main')
  <div class="card">
    <h4 class="card-header">Browse Halls</h4>
    <div class="card-body">
      <div class="form-group row">
        <label for="branch-input" class="col-form-label col-md-3"> Branch </label>
        <div class="col-md-9">
          <select class="form-control" id="branch-input" onchange="hallsTableHandler(this)">
            <option hidden disabled selected value> -- Choose a branch -- </option>
            @foreach ($branches as $branch)
              <option value="{{ $branch['id'] }}" @selected($branch['id'] == $branch_id)>
                {{ $branch['name'] }}
              </option>
            @endforeach
          </select>
        </div>
      </div>
      <div id="halls-table" class="table-responsive" style="display: none;"></div>
    </div>
  </div>
@endsection
