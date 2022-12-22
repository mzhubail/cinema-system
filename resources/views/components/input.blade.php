@props(['no-form-control', 'name', 'type' => 'text'])
<input {{ $attributes->merge(['class' => 'form-control']) }} type="{{ $type }}" name="{{ $name }}"
  id="{{ $name }}-input" @if (old($name) !== null) value="{{ old($name) }}" @endif>
