@props([
  'cover_count',
])

<section
  {{
    $attributes->merge([
      'class' => 'relative bg-surface-1 py-24 sm:py-20 text-center px-4 sm:px-20',
    ])
  }}
>
  <img class="absolute left-1/2 top-0 -translate-x-1/2 -translate-y-1/2" src="/icons/logo.svg" alt="Logo svg" />

  <x-h level="h3">{{ __('Discover :num Exclusive Titles You’ll Love!', ['num' => $cover_count]) }}</x-h>
  <x-button
    href="{{route('explore')}}"
    variant="primary"
    size="2xl"
    class="mx-auto mt-16 hidden w-full sm:block sm:w-fit"
  >
    {{ __('Explore') }}
  </x-button>
</section>
