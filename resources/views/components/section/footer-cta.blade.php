<section
  {{
    $attributes->merge([
      'class' => 'relative bg-surface-1 py-24 sm:py-20 text-center px-4 sm:px-20',
    ])
  }}
>
  <img class="absolute left-1/2 top-0 -translate-x-1/2 -translate-y-1/2" src="/icons/logo.svg" alt="Logo svg" />

  <!-- Desktop -->
  <x-h class="hidden sm:block" level="h3">Давай подорожувати сторінками разом</x-h>
  <x-button
    href="{{route('register')}}"
    variant="primary"
    size="2xl"
    class="mx-auto mt-16 hidden w-full sm:block sm:w-fit"
  >
    {{ __('Join') }}
  </x-button>

  <!-- Mobile -->
  <x-h class="sm:hidden" level="h5">Давай подорожувати сторінками разом</x-h>
  <x-button href="{{route('register')}}" variant="primary" size="xl" class="mx-auto mt-16 w-full sm:hidden sm:w-fit">
    {{ __('Join') }}
  </x-button>
</section>
<div class="bg-surface-1">
  <hr class="mx-auto h-[1px] w-[calc(100%-2rem)] text-on-surface-1 sm:w-[calc(100%-10rem)]" />
</div>
