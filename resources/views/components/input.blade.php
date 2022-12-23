@props(['no-form-control', 'name', 'type' => 'text', 'value'])
@php
  // Attempt use old value in case no value was explicitly passed
  if (!isset($value) && old($name) !== null) {
    $value = old($name);
  }
@endphp
<input {{ $attributes->merge(['class' => 'form-control']) }} type="{{ $type }}" name="{{ $name }}"
  id="{{ $name }}-input" @isset($value) value="{{ $value }}" @endisset>
