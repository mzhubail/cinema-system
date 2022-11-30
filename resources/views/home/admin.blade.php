@extends('layouts.master')

@section('title', 'Home')

@section('main')
  <a class="btn btn-primary" href="./browse_halls.php"> Browse Halls </a>
  <a class="btn btn-primary" href="./browse_movies.php"> Browse Movies </a>
  <a class="btn btn-primary" href="./browse_branches.php"> Browse Branches </a>
  <a class="btn btn-primary" href="./browse_time_slots.php"> Browse Time Slots </a>
  <br>
  <br>
  <a class="btn btn-primary" href="./add_branch.php"> Add Branch </a>
  <a class="btn btn-primary" href="./add_hall.php"> Add Hall </a>
  <a class="btn btn-primary" href="./add_movie.php"> Add Movie </a>
  <a class="btn btn-primary" href="./add_time_slot.php"> Add Time Slot </a>
  <br>
  <br>
@endsection
