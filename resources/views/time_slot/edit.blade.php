@extends('layouts.master')

@section('title', 'Edit Branch')

@section('main')
  <div class="container" style="max-width: var(--breakpoint-md);">
    <form method="post">
      @csrf
      <input type="hidden" name="time_slot" value="{{ $time_slot->id }}">
      <div class="card">
        <h4 class="card-header"> Add time slot </h4>
        <div class="card-body">
          <div class="form-group">
            <label for="branch-input">Movie</label>
            <select class="form-control" id="movie-input" disabled>
              <option>
                {{ $time_slot->movie->title }}
              </option>
            </select>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="branch-input">Branch</label>
              <select class="form-control" id="branch-input" disabled>
                <option>
                  {{ $time_slot->branch->name }}
                </option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="hall-input"> Hall </label>
              <select class="form-control" id="hall-input" disabled>
                <option>
                  {{ $time_slot->hall->letter }}
                </option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="date-input">Time slot date</label>
              <x-input type="date" name="date" :value="$time_slot->start_time->format('Y-m-d')" />
            </div>
            <div class="form-group col-md-6">
              <label for="time-input">Time slot time</label>
              <x-input type="time" name="time" :value="$time_slot->start_time->format('H:i')" />
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">Edit time slot</button>
          </div>
        </div>
      </div>
    </form>
  </div>

@endsection
