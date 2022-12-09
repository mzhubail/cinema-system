@extends('layouts.master')

@section('title', 'Browse Branches')

@section('main')
  <div class="table-responsive">
    <table class="table table-striped">
      <thead>
        <tr>
          @foreach (array_values($header) as $cell)
            <th scope="col">{{ $cell }}</th>
          @endforeach
          <th></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($branches as $branch)
          <tr>
            @foreach (array_keys($header) as $k)
              <td>{{ $branch[$k] }}</td>
            @endforeach
            <td>
              <a href="edit_branch?id={{ $branch['id'] }}"> Edit </a>
            </td>
            <td>
              <a href="browse_halls?bid={{ $branch['id'] }}"> Browse Halls </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection