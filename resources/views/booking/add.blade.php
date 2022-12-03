@extends('layouts.master')

@section('title', '')

@section('main')
  <form method="post" class="container" style="max-width: var(--breakpoint-sm);">
    @csrf
    <input type="hidden" name="payment_method" value="paypal">
    <div class="card">
      <div class="card-body">
        <div class="form-group">
          <label for="name-input">time_slot_id:</label>
          <input class="form-control" type="number" name="time_slot_id" id="name-input">
        </div>
        <div class="form-group">
          <label for="name-input">customer_id:</label>
          <input class="form-control" type="number" name="customer_id" id="name-input">
        </div>
        <div class="form-group">
          <label for="name-input">row:</label>
          <input class="form-control" type="number" name="row" id="name-input">
        </div>
        <div class="form-group">
          <label for="name-input">seats_start:</label>
          <input class="form-control" type="number" name="seats_start" id="name-input">
        </div>
        <div class="form-group">
          <label for="name-input">seats_end:</label>
          <input class="form-control" type="number" name="seats_end" id="name-input">
        </div>
        <div class="d-flex justify-content-end">
          <input class="btn btn-primary" type="submit" value="Add branch">
        </div>
      </div>
    </div>
  </form>
@endsection

