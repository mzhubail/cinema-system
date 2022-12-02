@extends('layouts.master')

@section('title', 'Home')

@section('main')
  <a class="btn btn-primary" href="./browse_halls"> Browse Halls </a>
  <a class="btn btn-primary" href="./browse_movies"> Browse Movies </a>
  <a class="btn btn-primary" href="./browse_branches"> Browse Branches </a>
  <a class="btn btn-primary" href="./browse_time_slots"> Browse Time Slots </a>
  <br>
  <br>
  <a class="btn btn-primary" href="./add_branch"> Add Branch </a>
  <a class="btn btn-primary" href="./add_hall"> Add Hall </a>
  <a class="btn btn-primary" href="./add_movie"> Add Movie </a>
  <a class="btn btn-primary" href="./add_time_slot"> Add Time Slot </a>
  <br>
  <br>
  <a class="btn btn-primary" href="/show_conflicts"> Show Time Slot conflicts </a>
@endsection
