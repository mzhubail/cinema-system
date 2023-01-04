@props(['bookings'])

@if ($bookings->isEmpty())
  <h4>No bookings to be shown</h4>

  <span class="mb-3 float-right">
    Date: {{ now()->toDateString() }} <br>
    Time: {{ now()->format('H:i') }}
  </span>
@else
  <div class="d-flex justify-content-end">
    <span class="mb-3">
      Date: {{ now()->toDateString() }} <br>
      Time: {{ now()->format('H:i') }}
    </span>
  </div>
  <div class="d-flex justify-content-between px-3 rounded-lg my-3 font-weight-bold">
    <div class="mr-5">
      ID
    </div>
    <div>
      Movie Title
    </div>

    <div class="ml-auto">
      Start Time
    </div>

    <div class="ml-4 invisible">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
        class="bi bi-info-circle-fill ml-1" viewBox="0 0 16 16">
        <path
          d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
      </svg>
    </div>

  </div>
  @foreach ($bookings as $booking)
    <div class="d-flex justify-content-between border p-3 rounded-lg mb-3">
      <div class="mr-5">
        {{ $booking->id }}
      </div>
      <div>
        {{ $booking->movie_title }}
      </div>

      <div class="ml-auto">
        {{ $booking->start_time->format('Y-m-d H:i') }}
      </div>

      <div class="ml-4">
        <a href="/booking_details?id={{ $booking->id }}">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
            class="bi bi-info-circle-fill ml-1" viewBox="0 0 16 16">
            <path
              d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
          </svg>
        </a>
      </div>

    </div>
  @endforeach
@endif
