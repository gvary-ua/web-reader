@props([
  'name' => '',
  'label' => null,
  'items' => [],
])

@php
  $selectId = uniqid('select_');
@endphp

<div {{ $attributes }}>
  @if ($label)
    <label for="{{ $selectId }}">
      <x-p class="mb-2" size="lg">{{ __($label) }}</x-p>
    </label>
  @endif

  <div class="relative">
    <select class="mr-2 w-full rounded-lg px-4 pr-12" id="{{ $selectId }}" name="{{ $name }}">
      @foreach ($items as $item)
        <option value="{{ $item['value'] }}" @if ($item['selected']) selected  @endif>
          {{ __($item['label']) }}
        </option>
      @endforeach
    </select>
  </div>
</div>
