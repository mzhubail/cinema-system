@props(['movie' => fake()->randomElement(App\Models\Movie::get())])

<div class="col mb-4">
  <div class="card">
    <div style="background:url({{ $movie->img_path }}) no-repeat center center / cover; height: 350px; width: 100%">
    </div>
    {{-- <a href="/movie_details?id={{ $movie->id }}">
      <img src="{{ $movie->img_path }}" class="card-img-top" alt="...">
    </a> --}}
    <div class="card-body">
      <h5 class="card-title"> {{ $movie->title }} </h5>
      <div class="text-muted"> Language </div>
      <div class=""> {{ $movie->lang }}</div>
      <div class="text-muted"> Rating </div>
      <div class=""> {{ $movie->rating }}</div>
      <a href="/choose_time_slot?mid={{ $movie->id }}" class="btn btn-primary float-right mt-3"> Book now </a>
    </div>
  </div>
</div>
