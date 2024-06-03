<x-app-layout>
  <section class="px-4 py-4 md:px-20 md:py-10">
    <x-h level="h3" class="hidden md:block">{{ __('My books') }}</x-h>
    <x-h level="h4" class="text-center md:hidden">{{ __('My books') }}</x-h>

    @foreach ($books as $book)
      <hr class="mx-auto my-12 h-[1px] w-full text-surface-1" />
      <x-books.card
        :title="$book['title']"
        :type="$book['type']"
        :author="$book['author']"
        :genres="$book['genres']"
        :description="$book['description']"
        :imgSrc="$book['imgSrc']"
        :chaptersTotal="$book['chaptersTotal']"
        :chaptersPublished="$book['chaptersPublished']"
      />
    @endforeach
  </section>
</x-app-layout>
