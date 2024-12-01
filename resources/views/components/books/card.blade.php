@props([
  'id',
  'user',
  'title',
  'type',
  'typeId',
  'genres',
  'description',
  'imgSrc' => asset('blank-224X320.webp'),
  'chaptersTotal',
  'chaptersPublished',
  'firstChapterId',
])

@php
  $desktopGrid =
    "md:[grid-template-areas:'image_header_header''image_genres_genres''image_description_description''image_chapters_button'] md:[grid-template-columns:auto_auto_1fr] md:[grid-template-rows:auto_auto_auto_1fr]";
  $mobileGrid =
    "[grid-template-areas:'header_header''image_genres''description_description''chapters_chapters''button_button'] [grid-template-columns:auto_1fr]";
@endphp

<div class="{{ $desktopGrid }} {{ $mobileGrid }} mt-4 grid items-start">
  <div class="relative [grid-area:image] md:max-h-80 md:pr-10">
    <a href="{{ route('books.show', ['book' => $id]) }}">
      <img
        width="100%"
        height="100%"
        class="max-h-32 min-h-32 min-w-24 max-w-24 rounded-lg object-cover md:max-h-80 md:min-h-80 md:min-w-56 md:max-w-56"
        src="{{ $imgSrc }}"
      />
      <x-badge size="sm" class="absolute bottom-2 left-2 bg-surface-1" type="square">{{ __($type) }}</x-badge>
    </a>
  </div>
  <div class="pb-4 [grid-area:header]">
    <a href="{{ route('books.show', ['book' => $id]) }}">
      <x-h level="h5">{{ $title }}</x-h>
    </a>
    <a href="{{ route('profile.show', ['user' => $user->user_id]) }}">
      <x-p class="mt-1 text-on-background-2" size="base">{{ $user->displayName() }}</x-p>
    </a>
  </div>
  <div class="-ml-4 -mt-4 pl-4 [grid-area:genres] md:pl-0">
    @foreach ($genres as $genre)
      <x-badge size="base" class="ml-4 mt-4 bg-surface-info">{{ __($genre) }}</x-badge>
    @endforeach
  </div>
  <x-p class="pt-4 [grid-area:description]">
    {{ $description }}
  </x-p>
  @if ($typeId == 1)
    <x-p class="pt-4 font-medium [grid-area:chapters] lg:leading-[38px]">
      {{ __('Chapters published') }}: {{ $chaptersPublished }}/{{ $chaptersTotal }}
    </x-p>
  @else
    <x-p class="pt-4 font-medium [grid-area:chapters] lg:leading-[38px]">
      {{ __('Verse published') }}: {{ $chaptersPublished == 1 ? __('yes') : __('no') }}
    </x-p>
  @endif
  <div class="flex flex-wrap [grid-area:button] md:justify-end md:space-x-2">
    @if (Auth::user() == $user)
      <form
        method="POST"
        onsubmit="return confirm('{{ __('Do you really want to delete the book?') }}')"
        class="w-full md:w-fit"
        action="{{ route('books.destroy', ['book' => $id]) }}"
      >
        @csrf
        @method('DELETE')
        <x-button type="submit" class="mt-4 w-full cursor-pointer md:h-fit md:w-fit" size="base" variant="secondary-2">
          <x-p size="base">{{ __('Delete') }}</x-p>
        </x-button>
      </form>
      <x-button
        class="mt-4 w-full md:h-fit md:w-fit"
        size="base"
        variant="secondary-1"
        href="{{ route('books.edit', ['book' => $id])}}"
      >
        <x-p size="base">{{ __('Edit') }}</x-p>
      </x-button>
      <x-button
        class="mt-4 w-full md:h-fit md:w-fit"
        size="base"
        variant="primary"
        href="{{config('app.spa_url')}}?coverId={{$id}}"
        target="_blank"
        rel="noopener noreferrer"
      >
        <x-p size="base">{{ __('Write') }}</x-p>
      </x-button>
    @else
      <x-button
        class="mt-4 w-full md:h-fit md:w-fit"
        icon="{{asset('icons/book.svg')}}"
        iconPosition="left"
        size="base"
        variant="secondary-2"
        href="{{route('chapters.show', ['book' => $id, 'chapter' => $firstChapterId])}}"
        target="_blank"
        rel="noopener noreferrer"
      >
        <x-p size="base">{{ __('Read') }}</x-p>
      </x-button>
    @endif
  </div>
</div>
