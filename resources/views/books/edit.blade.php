@props([
  'cover_id',
  'cover_type_id',
  'title',
  'description',
  'genres',
  'languages',
  'chapters',
  'type' => 'cover.types.book',
  'imgSrc' => asset('blank-224X320.webp'),
])

<x-app-layout>
  <section class="px-4 pt-8 md:px-20 md:pt-14">
    <div class="mx-auto md:max-w-[60rem]">
      <form method="POST" action="{{ route('books.update', ['book' => $cover_id]) }}">
        @csrf
        @method('PUT')
        <div class="md:flex">
          <div
            class="relative mx-auto max-h-64 min-h-64 min-w-48 max-w-48 md:ml-0 md:mr-8 md:max-h-96 md:min-h-96 md:min-w-72 md:max-w-72"
          >
            <img
              width="100%"
              height="100%"
              class="max-h-64 min-h-64 min-w-48 max-w-48 rounded-lg object-cover md:max-h-96 md:min-h-96 md:min-w-72 md:max-w-72"
              src="{{ $imgSrc }}"
            />
            <x-badge size="sm" class="absolute bottom-2 left-2 bg-surface-1" type="square">
              {{ __($type) }}
            </x-badge>
          </div>
          <div class="mt-2 w-full md:mt-0">
            <x-input id="title" name="title" label="{{__('Title')}}:" value="{{$title}}" />
            <x-checkbox-holder
              name="genres[]"
              label="{{__('Genre')}}:"
              :items="$genres"
              class="mt-4"
              innerClass="h-40"
            ></x-checkbox-holder>
            <x-select name="lang" label="{{__('Language')}}:" :items="$languages" class="mt-6"></x-select>
          </div>
        </div>
        <x-textarea name="description" limit="700" label="{{__('Description')}}:" class="mt-6 min-h-72 md:min-h-44">
          {{ $description }}
        </x-textarea>
        <x-p size="sm" class="mt-2">
          {{ __('Our search engine relies on your book\'s description, so be sure to make it detailed and engaging!') }}
        </x-p>
        <x-checkbox-holder
          name="public_chapters[]"
          label="{{ ($cover_type_id == 1) ? __('Published chapters') : __('Publish verse')}}:"
          :items="$chapters"
          class="mt-6"
          innerClass="max-h-40"
        ></x-checkbox-holder>
        @if ($cover_type_id == 1)
          <x-p size="sm" class="mt-2">
            {{ __('Your book becomes visible to others once you\'ve published at least one chapter.') }}
          </x-p>
          <x-p size="sm">{{ __('If no chapters are published, it will remain hidden.') }}</x-p>
        @endif

        <div class="mb-14 mt-14 md:flex md:justify-between">
          <x-button class="w-full md:w-fit" href="{{route('books.index')}}" variant="secondary-2" size="base">
            {{ __('Back') }}
          </x-button>
          <x-button class="mt-4 w-full md:mt-0 md:w-fit" type="submit" variant="primary" size="base">
            {{ __('Save') }}
          </x-button>
        </div>
      </form>
    </div>
  </section>
</x-app-layout>
