@props([
  'bookId',
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

<x-app-layout>
  <section class="flex px-4 py-8 md:px-20 md:pt-10">
    <nav class="hidden min-w-48 overflow-y-auto md:block" x-data="{ open: false }">
      <img
        src="/icons/gear.svg"
        alt="Open navigation"
        class="mr-auto min-h-8 w-8 cursor-pointer"
        x-on:click="open = !open"
        x-show="!open"
      />
      <div x-cloak x-show="open">
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
    <main class="w-full overflow-y-auto px-3 md:px-20">
      blocks
      @foreach ($blocks as $block)
        <p>{{ $block->data->text }}</p>
      @endforeach
    </main>
  </section>
</x-app-layout>
