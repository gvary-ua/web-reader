@props([
  'level' => 'h1',
])

@php
  switch ($level) {
    case 'h1':
    default:
      $levelClasses = 'font-roslindaleCyrillic text-[2.5rem] leading-tight sm:text-[4.5rem] sm:leading-[0.825] md:text-[6rem] lg:text-[8rem]';
      break;
    case 'h2':
      $levelClasses = 'font-robotoFlex text-[2.5rem] leading-tight sm:text-[4.5rem] sm:leading-[0.825] md:text-[6rem] lg:text-[8rem]';
      break;
    case 'h3':
      $levelClasses = 'font-roslindaleCyrillic text-[3rem] leading-none';
      break;
    case 'h4':
      $levelClasses = 'font-robotoFlex text-[2rem] leading-none';
      break;
    case 'h5':
      $levelClasses = 'font-roslindaleCyrillic text-[1.125rem] leading-none';
      break;
  }
@endphp

<{{ $level }} {{ $attributes->merge(['class' => implode(' ', [$levelClasses])]) }}>
  {{ $slot }}
</{{ $level }}>
