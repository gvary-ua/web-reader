@props([
  'size' => 'base',
  'type' => 'round',
])

@php
  $sizeClasses = [
    'xs' => 'px-[8px] py-[3px]',
    'sm' => 'px-[8px] py-[6px]',
    'base' => 'px-[18px] py-[6px]',
    'lg' => 'px-[14px] py-[6px]',
  ];
  $typeClasses = [
    'round' => 'rounded-10',
    'square' => 'rounded-[4px]',
  ];
  $pSizeClasses = [
    'xs' => 'xs',
    'sm' => 'sm',
    'base' => 'base',
    'lg' => 'base',
  ];
@endphp

<div {{ $attributes->merge(['class' => implode(' ', ['inline-block', $sizeClasses[$size], $typeClasses[$type]])]) }}>
  <x-p size="{{ $pSizeClasses[$size] }}">{{ $slot }}</x-p>
</div>
