<a
  {{
    $attributes->merge([
      'class' => 'block',
    ])
  }}
  href="{{ route('profile.index') }}"
>
  <x-p>{{ __('My profile') }}</x-p>
</a>
