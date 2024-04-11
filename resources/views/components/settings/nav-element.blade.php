@props([
  'route',
  'label',
  'user',
])

@php
  $activeClasses = Route::is($route) ? 'bg-surface-2' : '';
@endphp

<li>
  <a
    {{
      $attributes->merge([
        'class' => implode(' ', [$activeClasses, 'block rounded-lg pb-3 pl-6 pr-4 pt-3 hover:bg-surface-2']),
      ])
    }}
    href="{{ route($route, ['user' => Auth::user()]) }}"
  >
    <x-p>{{ __($label) }}</x-p>
  </a>
</li>
