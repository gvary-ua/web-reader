@props([
  'bookId',
  'title',
  'chapters' => [],
  'blocks' => [],
  'curr_chapter',
])

@section('header.mobile-dropdown-menu.before')
  <x-chapters
    class="border-b border-b-surface-1 py-4"
    :bookId="$bookId"
    :chapters="$chapters"
    :currChapterId="$curr_chapter['chapter_id']"
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
            :bookId="$bookId"
            :chapters="$chapters"
            :currChapterId="$curr_chapter['chapter_id']"
          />
        </div>
      </div>
    </nav>
    <main class="w-full overflow-y-auto px-3 py-3 md:px-20 md:pt-10">
      <x-h class="pb-[3px] pt-[0.6em]" level="h3">{{ $title }}</x-h>
      <x-h class="pb-[3px] pt-[0.6em]" level="h4">{{ $curr_chapter->title }}</x-h>
      <div class="my-4 border-b border-b-surface-1"></div>
      <x-blocks.index :blocks="$blocks" />
    </main>
  </section>
</x-app-layout>
