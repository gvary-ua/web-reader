<a
  {{
    $attributes->merge([
      'class' => 'block',
    ])
  }}
  href="{{ route('profile.books.index', ['user' => Auth::user()]) }}"
>
  <x-p>{{ __('My books') }}</x-p>
</a>
