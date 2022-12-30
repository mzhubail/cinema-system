@props(['movies'])
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 justify-content-center">
  @isset($movies)
    @foreach ($movies as $movie)
      <x-movie-card :movie="$movie" />
    @endforeach
  @else
    {{ $slot }}
  @endisset
</div>
