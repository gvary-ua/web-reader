@props(['type' => 'success'])

@php
  $classes = [
    'success' => 'text-success',
    'error' => 'text-error',
  ];
@endphp

@session('status')
  <x-p
    {{ $attributes->merge(['class' => $classes[$type]]) }}
    x-data="{ show: true }"
    x-show="show"
    x-init="setTimeout(() => (show = false), 3000)"
  >
    {{ __($value) }}
  </x-p>
@endsession
