@props(['no-form-control', 'name', 'type' => 'text', 'value'])
@php
  // old input take precedence over passed value
  if (old($name) !== null)
    $value = old($name);
@endphp
<input {{ $attributes->merge(['class' => 'form-control']) }} type="{{ $type }}" name="{{ $name }}"
  id="{{ $name }}-input" @isset($value) value="{{ $value }}" @endisset>
