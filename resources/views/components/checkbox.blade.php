@props([
  'name',
  'value',
  'label',
  'checked' => false,
])

@php
  $checkboxId = uniqid('checkbox_');
@endphp

<div class="flex items-center pl-1">
  <input
    type="checkbox"
    id="{{ $checkboxId }}"
    name="{{ $name }}"
    value="{{ $value }}"
    @if($checked) checked @endif
  />
  <label for="{{ $checkboxId }}" class="ml-2">
    <x-p size="lg">{{ __($label) }}</x-p>
  </label>
</div>
