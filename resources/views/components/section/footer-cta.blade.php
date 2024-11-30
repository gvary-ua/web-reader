<section
  {{
    $attributes->merge([
      'class' => 'relative bg-surface-1 py-24 sm:py-20 text-center px-4 sm:px-20',
    ])
  }}
>
  <img class="absolute left-1/2 top-0 -translate-x-1/2 -translate-y-1/2" src="/icons/logo.svg" alt="Logo svg" />

  <x-h level="h3">{{ __("Let's travel through the pages together") }}</x-h>
  @guest
    <x-button href="{{route('register')}}" variant="primary" size="2xl" class="mx-auto mt-16 w-full sm:block sm:w-fit">
      {{ __('Join') }}
    </x-button>
  @endguest

  @auth
    <div class="mt-12 flex flex-wrap justify-center space-y-4 md:space-x-4 md:space-y-0">
      <form method="POST" class="w-full md:w-fit" action="{{ route('books.store') }}">
        @csrf
        <input name="coverTypeId" type="hidden" value="1" />

        <x-button type="submit" variant="primary" size="2xl" class="w-full md:w-fit">
          {{ __('Write book') }}
        </x-button>
      </form>

      <form method="POST" class="w-full md:w-fit" action="{{ route('books.store') }}">
        @csrf
        <input name="coverTypeId" type="hidden" value="2" />

        <x-button type="submit" variant="primary" size="2xl" class="w-full md:w-fit">
          {{ __('Write verse') }}
        </x-button>
      </form>
    </div>
  @endauth
</section>
<div class="bg-surface-1">
  <hr class="mx-auto h-[1px] w-[calc(100%-2rem)] text-on-surface-1 sm:w-[calc(100%-10rem)]" />
</div>
