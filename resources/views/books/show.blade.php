@props([
  'id',
  'user',
  'bookId',
  'typeId',
  'title',
  'type',
  'genres',
  'description',
  'imgSrc' => asset('blank-224X320.webp'),
  'chaptersTotal',
  'chaptersPublished',
  'firstChapterId' => 1,
  'views',
  'uniqueViews',
  'i_like' => null,
  'likes',
])

@php
  if ($i_like) {
    $likeAsset = asset('icons/like-after-click.svg');
  } else {
    $likeAsset = asset('icons/like-before-click.svg');
  }
  // 'image_header'
  // 'image_genres'
  // 'image_description'
  // 'image_button'
  $desktopGrid = "md:[grid-template-areas:'image_header''image_genres''image_description''image_button'] md:[grid-template-columns:auto_1fr] md:[grid-template-rows:auto_auto_1fr_auto]";
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
        <a href="{{ route('profile.show', ['user' => $user->user_id]) }}">
          <x-p class="mt-2 text-on-background-2" size="base">{{ $user->displayName() }}</x-p>
        </a>
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
        <form class="mt-4 w-full" action="{{ route('books.like', ['book' => $id]) }}" method="post">
          @csrf

          <x-button
            class="w-full"
            icon="{{$likeAsset}}"
            iconPosition="left"
            size="base"
            variant="secondary-2"
            type="submit"
          >
            <x-p class="text-nowrap" size="base">{{ $likes }} {{ __('Like') }}</x-p>
          </x-button>
        </form>
        <x-button
          class="mt-4 w-full"
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
      </div>
    </div>
  </section>
  <section class="px-4 py-8 md:px-20 md:py-10">
    <div class="md:mx-auto md:flex md:max-w-[60rem] md:items-center md:justify-between">
      <div class="mx-auto text-center md:mx-0">
        <x-p size="base">{{ __('Author') }}:</x-p>
        <a href="{{ route('profile.show', ['user' => $user->user_id]) }}">
          <img src="/icons/user.svg" alt="{{ $user->displayName() }}" class="mx-auto mt-2 h-20 w-20 rounded-full" />
          <x-p class="mt-2" size="base">{{ $user->displayName() }}</x-p>
        </a>
      </div>
      <div class="my-8 h-[1px] w-full bg-surface-1 md:my-0 md:h-28 md:w-[1px]"></div>
      <div class="flex min-w-60 justify-between">
        <div class="space-y-4">
          {{-- <x-p size="base">{{ __('Is complete') }}:</x-p> --}}
          <x-p size="base">{{ __('Views') }}:</x-p>
          @if ($typeId == 1)
            <x-p size="base">{{ __('Chapters') }}:</x-p>
          @endif

          <x-p size="base">{{ __('Language') }}:</x-p>
        </div>
        <div class="space-y-4 text-on-background-2">
          {{-- <x-p size="base">{{ __($coverStatus) }}</x-p> --}}
          <x-p size="base">{{ $views }}</x-p>
          @if ($typeId == 1)
            <x-p size="base">{{ $chaptersPublished . ' / ' . $chaptersTotal }}</x-p>
          @endif

          <x-p size="base">{{ __($language) }}</x-p>
        </div>
      </div>
      <div class="my-8 h-[1px] w-full bg-surface-1 md:h-28 md:w-[1px]"></div>
      <div class="flex min-w-60 justify-between">
        <div class="space-y-4">
          <x-p size="base">{{ __('Unique views') }}:</x-p>
          <x-p size="base">{{ __('Updated at') }}:</x-p>
          <x-p size="base">{{ __('Published at') }}:</x-p>
          {{-- <x-p size="base">{{ __('Reading time') }}:</x-p> --}}
        </div>
        <div class="space-y-4 text-on-background-2">
          <x-p size="base">{{ $uniqueViews }}</x-p>
          <x-p size="base">{{ $updatedAt }}</x-p>
          <x-p size="base">{{ $publishedAt }}</x-p>
          {{-- <x-p size="base">{{ $readingTime . ' ' . __('min') }}</x-p> --}}
        </div>
      </div>
    </div>
  </section>
  {{-- TODO: Similar books section --}}
</x-app-layout>
