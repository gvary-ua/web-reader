@props([
  'user',
])

@php
  $sameUser = Auth::user() == $user;
  if ($sameUser) {
    $headerTitle = __('My books');
  } else {
    $headerTitle = $user->displayName() . ' ' . __('books');
  }
@endphp

<x-app-layout>
  <section class="px-4 py-4 md:px-20 md:py-10">
    <x-h level="h3" class="hidden md:block">{{ $headerTitle }}</x-h>
    <x-h level="h4" class="text-center md:hidden">{{ $headerTitle }}</x-h>

    @foreach ($books as $book)
      <hr class="mx-auto mb-12 mt-4 h-[1px] w-full text-surface-1" />
      <x-books.card
        :id="$book['id']"
        :user="$user"
        :typeId="$book['typeId']"
        :title="$book['title']"
        :type="$book['type']"
        :genres="$book['genres']"
        :description="$book['description']"
        :imgSrc="$book['imgSrc']"
        :chaptersTotal="$book['chaptersTotal']"
        :chaptersPublished="$book['chaptersPublished']"
        :firstChapterId="$book['firstChapterId']"
      />
    @endforeach
  </section>
</x-app-layout>
