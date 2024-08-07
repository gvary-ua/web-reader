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
  $desktopGrid =
    "md:[grid-template-areas:'image_header_header''image_genres_genres''image_description_description''image_chapters_button'] md:[grid-template-columns:auto_auto_1fr] md:[grid-template-rows:auto_auto_auto_1fr]";
  $mobileGrid =
    "[grid-template-areas:'header_header''image_genres''description_description''chapters_chapters''button_button'] [grid-template-columns:auto_1fr]";
@endphp

<div class="{{ $desktopGrid }} {{ $mobileGrid }} mt-4 grid items-start">
  <div class="relative [grid-area:image] md:max-h-80 md:pr-10">
    <img
      width="100%"
      height="100%"
      class="max-h-32 min-h-32 min-w-24 max-w-24 rounded-lg object-cover md:max-h-80 md:min-h-80 md:min-w-56 md:max-w-56"
      src="{{ $imgSrc }}"
    />
    <x-badge size="sm" class="absolute bottom-2 left-2 bg-surface-1" type="square">{{ __($type) }}</x-badge>
  </div>
  <div class="pb-4 [grid-area:header]">
    <x-h level="h5">{{ $title }}</x-h>
    <x-p class="mt-1 text-on-background-2" size="base">{{ $author }}</x-p>
    <x-p class="mt-1 text-on-background-2" size="base">{{ '@' . $login }}</x-p>
  </div>
  <div class="-ml-4 -mt-4 pl-4 [grid-area:genres] md:pl-0">
    @foreach ($genres as $genre)
      <x-badge size="base" class="ml-4 mt-4 bg-surface-info">{{ __($genre) }}</x-badge>
    @endforeach
  </div>
  <x-p class="pt-4 [grid-area:description]">
    {{ $description }}
  </x-p>
  <x-p class="pt-4 font-medium [grid-area:chapters] lg:leading-[38px]">
    {{ __('Chapters published') }}: {{ $chaptersPublished }}/{{ $chaptersTotal }}
  </x-p>
  <div class="flex flex-wrap [grid-area:button] md:justify-end md:space-x-2">
    {{-- TODO: Open a modal and ask if you really want to Delete --}}
    <x-button class="mt-4 w-full cursor-pointer md:h-fit md:w-fit" size="base" variant="secondary-2">
      <x-p size="base">{{ __('Delete') }}</x-p>
    </x-button>
    {{-- TODO: Edit and publish page --}}
    <x-button class="mt-4 w-full md:h-fit md:w-fit" size="base" variant="secondary-1" href="">
      <x-p size="base">{{ __('Edit') }}</x-p>
    </x-button>
    <x-button
      class="mt-4 w-full md:h-fit md:w-fit"
      size="base"
      variant="primary"
      href="{{config('app.spa_url')}}?coverId={{$id}}&coverTypeId={{$typeId}}"
      target="_blank"
      rel="noopener noreferrer"
    >
      <x-p size="base">{{ __('Write') }}</x-p>
    </x-button>
  </div>
</div>
