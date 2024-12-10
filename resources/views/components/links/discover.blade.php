<a
  {{
    $attributes->merge([
      'class' => 'block',
    ])
  }}
  href="{{ route('explore') }}"
>
  <x-p>{{ __('Discover') }}</x-p>
</a>
