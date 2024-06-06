{{-- @props(['movie' => fake()->randomElement(App\Models\Movie::get())]) --}}
@props(['movie'])

<div class="col mb-4">
  <div class="card shadow">
    <a href="/movie_details?id={{ $movie->id }}">
      <div style="background:url({{ $movie->img_path }}) no-repeat center center / cover; height: 350px; width: 100%">
      </div>
    </a>
    <div class="card-body">
      <h5 class="card-title"> {{ $movie->title }} </h5>
      <div class="text-muted"> Rating </div>
      <div class="my-1"> <x-rating :rating="$movie->rating" :show_number="false"/> </div>
      <div class="text-muted"> Language </div>
      <div class=""> {{ $movie->lang }}</div>
      <div class="text-muted"> Rating </div>
      <div class=""> {{ $movie->rating }}</div>
      <a href="/choose_time_slot?mid={{ $movie->id }}" class="btn btn-primary float-right mt-3"> Book now </a>
    </div>
  </div>
</div>
