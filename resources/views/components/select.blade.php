@props(['values', 'name'])

<select {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $name }}" id="{{ $name }}-input">

  @foreach ($values as $value => $option)
    <option value="{{ $value }}" @selected(old($name) == $value)> {{ $option }} </option>
  @endforeach
</select>
