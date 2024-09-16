@props([
  'name',
  'limit',
  'label',
])

@php
  $textareaId = uniqid('textarea_');
@endphp

<div {{ $attributes }}>
  <label for="{{ $textareaId }}" class="w-full">
    <x-p class="mb-2" size="lg">{{ $label }}</x-p>
  </label>

  <div x-data="{ textareaModel: '' }" class="relative min-h-[inherit] w-full text-on-surface-1">
    <textarea
      id="{{ $textareaId }}"
      name="{{ $name }}"
      x-model.fill="textareaModel"
      maxlength="{{ $limit }}"
      class="min-h-[inherit] w-full rounded-lg border-surface-1 bg-surface-2"
    >
{{ $slot }}</textarea
    >

    <div class="absolute bottom-4 right-4 text-on-background-2">
      <x-p size="sm">
        <span x-text="textareaModel.length"></span>
        /
        <span>{{ $limit }}</span>
      </x-p>
    </div>
  </div>
</div>
