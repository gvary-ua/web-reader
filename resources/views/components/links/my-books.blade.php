<a
  {{
    $attributes->merge([
      'class' => 'block',
    ])
  }}
  href="{{ route('books.index') }}"
>
  <x-p>{{ __('My books') }}</x-p>
</a>
