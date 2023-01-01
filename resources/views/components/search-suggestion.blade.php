@props(['movie'])
<a href='/movie_details?id={{ $movie->id }}' class='p-2 list-group-item list-group-item-action'>
  {{ $movie->title }}
</a>
