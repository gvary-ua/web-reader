<section
  {{
    $attributes->merge([
      'class' => 'relative bg-secondary-1 text-on-secondary-1 px-4 py-10 sm:px-10 md:px-14 lg:px-16',
    ])
  }}
>
  <x-h level="h1">{{ __('The community of writers') }}</x-h>
  <x-h level="h2" class="font-bold">{{ __('and readers') }}</x-h>
  <x-p size="2xl" class="mt-6 sm:mt-10">
    {{ __('Immerse yourself in a universe') }}
    <br class="sm:hidden" />
    {{ __('where you can write and') }}
    <br class="sm:hidden" />
    {{ __('discuss') }}
    <br class="hidden md:inline lg:hidden" />
    {{ __('the best') }}
    <br class="sm:hidden" />
    {{ __('stories') }}
    <br class="hidden lg:inline" />
    {{ __('and novels') }}
    <br class="sm:hidden" />
    {{ __('worthy of your attention') }}
  </x-p>
  @guest
    <x-button href="{{route('register')}}" variant="primary" size="2xl" class="mt-12 w-full sm:w-fit">
      {{ __('Join') }}
    </x-button>
  @endguest

  @auth
    <div class="mt-12 flex flex-wrap space-y-4 md:space-x-4 md:space-y-0">
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

        <x-button type="submit" variant="secondary-2" size="2xl" class="w-full md:w-fit">
          {{ __('Write verse') }}
        </x-button>
      </form>
    </div>
  @endauth

  <x-gvary-comment class="mb-[-5rem] mt-8" />
</section>
