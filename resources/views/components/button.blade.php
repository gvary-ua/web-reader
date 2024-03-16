@props([
  'variant' => 'primary',
  'size' => 'base',
  'icon',
  'iconPosition' => 'right',
])

@php
  switch ($variant) {
    case 'primary':
    default:
      $alignmentClasses = 'img:invert-0 bg-primary-1 text-on-primary-1 hover:bg-primary-2';
      break;
    case 'secondary-1':
      $alignmentClasses = 'bg-secondary-1 text-on-secondary-1 hover:bg-secondary-3';
      break;
    case 'secondary-2':
      $alignmentClasses = 'bg-surface-2 text-on-surface-2 hover:bg-surface-3';
      break;
  }

  switch ($size) {
    case 'xs':
      $sizeClasses = 'pb-2 pl-5 pr-5 pt-2 text-xs';
      break;
    case 'sm':
      $sizeClasses = 'pb-2 pl-6 pr-6 pt-2 text-xs';
      break;
    case 'base':
    default:
      $sizeClasses = 'pb-2.5 pl-12 pr-12 pt-2.5 text-sm';
      break;
    case '2xl':
      $sizeClasses = 'pb-6 pl-14 pr-14 pt-6 text-xl font-semibold';
      break;
  }

  $iconPositionClasses = '';
  if ($iconPosition === 'right') {
    $iconPositionClasses = 'flex-row-reverse';
  }
  $icon = '';

  if ($attributes['type']) {
    $tag = 'button';
  } else {
    $tag = 'a';
  }
@endphp

<{{ $tag }}
  {{
    $attributes->merge([
      'class' => implode(' ', [$alignmentClasses, $sizeClasses, $iconPositionClasses, 'font-robotoFlex disabled:opacity-40 inline-block rounded-10 w-fit leading-4 flex gap-2.5 font-medium flex items-center justify-center']),
    ])
  }}
>
  @if ($icon)
    <img src="{{ $icon }}" alt="icon" />
  @endif

  {{ $slot }}
</{{ $tag }}>
