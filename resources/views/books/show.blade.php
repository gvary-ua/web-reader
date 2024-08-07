@props([
  'id',
  'typeId',
  'title',
  'type',
  'author',
  'login',
  'genres',
  'description',
  'imgSrc' => asset('blank-224X320.webp'),
  'chaptersTotal',
  'chaptersPublished',
])

@php
  // 'image_header'
  // 'image_genres'
  // 'image_description'
  // 'image_button'
  $desktopGrid =
    "md:[grid-template-areas:'image_header''image_genres''image_description''image_button'] md:[grid-template-columns:auto_1fr] md:[grid-template-rows:auto_auto_1fr_auto]";
@endphp

<x-app-layout>
  <section class="bg-secondary-1 px-4 py-8 md:px-20 md:py-10">
    <div class="{{ $desktopGrid }} mx-auto items-start md:grid md:max-w-[60rem]">
      <div class="relative mx-auto max-w-fit [grid-area:image] md:mr-8">
        <img
          width="100%"
          height="100%"
          class="max-h-64 min-h-64 min-w-48 max-w-48 rounded-lg object-cover md:max-h-96 md:min-h-96 md:min-w-72 md:max-w-72"
          src="{{ $imgSrc }}"
        />
        <x-badge size="sm" class="absolute bottom-2 left-2 bg-surface-1" type="square">{{ __($type) }}</x-badge>
      </div>
      <div class="text-center [grid-area:header] md:text-left">
        <x-h class="mt-3 md:mt-0" level="h5">{{ $title }}</x-h>
        <x-p class="mt-2 text-on-background-2" size="base">{{ $author }}</x-p>
        {{-- TODO: Make a link to a profile --}}
        <x-p class="text-on-background-2" size="base">{{ '@' . $login }}</x-p>
      </div>

      <div class="[grid-area:genres]">
        @foreach ($genres as $genre)
          <x-badge size="base" class="mt-4 bg-background">{{ __($genre) }}</x-badge>
        @endforeach
      </div>
      <x-p class="mt-6 [grid-area:description]">
        {{ $description }}
      </x-p>
      {{-- TODO: Like functionality --}}
      <div class="flex flex-wrap [grid-area:button] md:flex-nowrap md:space-x-2">
        <x-button
          class="mt-4 w-full"
          icon="{{asset('icons/like-before-click.svg')}}"
          iconPosition="left"
          size="base"
          variant="secondary-2"
          href=""
        >
          <x-p size="base">{{ __('Like') }}</x-p>
        </x-button>
        {{-- TODO: Read functionality --}}
        <x-button
          class="mt-4 w-full"
          icon="{{asset('icons/book.svg')}}"
          iconPosition="left"
          size="base"
          variant="secondary-2"
          href=""
          target="_blank"
          rel="noopener noreferrer"
        >
          <x-p size="base">{{ __('Read') }}</x-p>
        </x-button>
      </div>
    </div>
  </section>
  <section class="px-4 py-8 md:px-20 md:py-10">
    <div class="md:mx-auto md:flex md:max-w-[60rem] md:items-center md:justify-between">
      <div class="mx-auto text-center md:mx-0">
        <x-p size="base">{{ __('Author') }}:</x-p>
        <img src="/icons/user.svg" alt="{{ $login }}" class="mx-auto mt-2 h-20 w-20 rounded-full" />
        <x-p class="mt-2" size="base">{{ $author }}</x-p>
        {{-- TODO: Make a link to a profile --}}
        <x-p size="base">{{ '@' . $login }}</x-p>
      </div>
      <div class="my-8 h-[1px] w-full bg-surface-1 md:my-0 md:h-28 md:w-[1px]"></div>
      <div class="flex min-w-60 justify-between">
        <div class="space-y-4">
          <x-p size="base">{{ __('Is complete') }}:</x-p>
          <x-p size="base">{{ __('Chapters') }}:</x-p>
          <x-p size="base">{{ __('Language') }}:</x-p>
        </div>
        <div class="space-y-4 text-on-background-2">
          <x-p size="base">{{ __($coverStatus) }}</x-p>
          <x-p size="base">{{ $chaptersPublished . ' / ' . $chaptersTotal }}</x-p>
          <x-p size="base">{{ __($language) }}</x-p>
        </div>
      </div>
      <div class="my-8 h-[1px] w-full bg-surface-1 md:h-28 md:w-[1px]"></div>
      <div class="flex min-w-60 justify-between">
        <div class="space-y-4">
          <x-p size="base">{{ __('Updated at') }}:</x-p>
          <x-p size="base">{{ __('Published at') }}:</x-p>
          <x-p size="base">{{ __('Reading time') }}:</x-p>
        </div>
        <div class="space-y-4 text-on-background-2">
          <x-p size="base">{{ $updatedAt }}</x-p>
          <x-p size="base">{{ $publishedAt }}</x-p>
          <x-p size="base">{{ $readingTime . ' ' . __('min') }}</x-p>
        </div>
      </div>
    </div>
  </section>
  {{-- TODO: Similar books section --}}
</x-app-layout>
