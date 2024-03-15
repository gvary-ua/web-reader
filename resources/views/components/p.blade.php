@props([
  'size' => 'base',
])

@php
  switch ($size) {
    case 'xs':
      $levelClasses = 'text-xs leading-none';
      break;
    case 'sm':
      $levelClasses = 'text-sm leading-[1.15]';
      break;
    case 'base':
    default:
      $levelClasses = 'text-base leading-[1.15]';
      break;
    case 'lg':
      $levelClasses = 'text-lg leading-[1.33]';
      break;
    case 'xl':
      $levelClasses = 'text-xl leading-tight';
      break;
    case '2xl':
      $levelClasses = 'text-2xl leading-tight';
      break;
  }
@endphp

<p {{ $attributes->merge(['class' => implode(' ', [$levelClasses])]) }}>
  {{ $slot }}
</p>
