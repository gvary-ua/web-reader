@props([
  'book_id',
  'title',
  'chapters' => [],
  'blocks' => [],
  'curr_chapter',
  'prev_chapter_id',
  'next_chapter_id',
])

@section('header.mobile-dropdown-menu.before')
  <x-chapters
    class="border-b border-b-surface-1 py-4"
    :bookId="$book_id"
    :chapters="$chapters"
    :currChapterId="$curr_chapter->chapter_id"
  />
@endsection

@section('styles')
  <style>
    .main {
      overflow-y: hidden !important;
    }
    footer {
      display: none !important;
    }
  </style>
@endsection

@php
  $chapterButtonsJustify = '';
  if ($prev_chapter_id && $next_chapter_id) {
    $chapterButtonsJustify = 'justify-between';
  } elseif ($prev_chapter_id) {
    $chapterButtonsJustify = 'justify-start';
  } elseif ($next_chapter_id) {
    $chapterButtonsJustify = 'justify-end';
  }
@endphp

<x-app-layout>
  <section
    class="flex h-auto max-h-[calc(100vh-3.5rem)] min-h-[calc(100vh-3.5rem)] w-full md:max-h-[calc(100vh-4.25rem)] md:min-h-[calc(100vh-4.25rem)] md:pl-20"
  >
    <nav class="hidden min-w-48 overflow-y-auto pt-10 md:block" x-data="{ open: true }">
      <img
        src="/icons/gear.svg"
        alt="Open navigation"
        class="mr-auto min-h-8 w-8 cursor-pointer"
        x-on:click="open = !open"
        x-show="!open"
        x-cloak
      />
      <div x-show="open">
        <div class="min-h-8 p-[6px]" x-on:click="open = !open">
          <img src="/icons/chevrons-left.svg" alt="Close navigation" class="ml-auto w-5 cursor-pointer" />
        </div>
        <div class="px-[6px] pt-2">
          <x-chapters
            class="py-5"
            :bookId="$book_id"
            :chapters="$chapters"
            :currChapterId="$curr_chapter->chapter_id"
          />
        </div>
      </div>
    </nav>
    <main class="w-full overflow-y-auto px-3 py-3 pb-20 md:px-20 md:py-10">
      <x-h class="pb-[3px] pt-[0.6em]" level="h3">{{ $title }}</x-h>
      <x-h class="pb-[3px] pt-[0.6em]" level="h4">{{ $curr_chapter->title }}</x-h>
      <div class="my-4 border-b border-b-surface-1"></div>
      <x-blocks.index :blocks="$blocks" />
      <hr class="mx-auto my-12 h-[1px] w-full text-surface-1" />
      <div class="{{ $chapterButtonsJustify }} mt-12 flex flex-wrap space-y-4 md:space-y-0">
        @if ($prev_chapter_id)
          <x-button
            href="{{route('chapters.show', ['book' => $book_id, 'chapter' => $prev_chapter_id])}}"
            variant="secondary-2"
            size="xl"
            class="w-full md:w-fit"
            icon="{{asset('icons/arrow-left.svg')}}"
            iconPosition="left"
          >
            {{ __('Previous chapter') }}
          </x-button>
        @endif

        @if ($next_chapter_id)
          <x-button
            href="{{route('chapters.show', ['book' => $book_id, 'chapter' => $next_chapter_id])}}"
            variant="secondary-2"
            size="xl"
            class="w-full md:w-fit"
            icon="{{asset('icons/arrow-right.svg')}}"
            iconPosition="right"
          >
            {{ __('Next chapter') }}
          </x-button>
        @endif
      </div>
    </main>
  </section>
</x-app-layout>
