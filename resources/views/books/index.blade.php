@props([
  'user',
])

@php
  $sameUser = 'false';
  if (Auth::user() == $user) {
    $sameUser = 'true';
  }
@endphp

<x-app-layout>
  <section class="px-4 py-4 md:px-20 md:py-10">
    @if (Auth::user() == $user)
      <x-h level="h3" class="hidden md:block">{{ __('My books') }}</x-h>
      <x-h level="h4" class="text-center md:hidden">{{ __('My books') }}</x-h>
    @else
      <x-h level="h3" class="hidden md:block">{{ '@' . $user->login . ' ' . __('books') }}</x-h>
      <x-h level="h4" class="text-center md:hidden">{{ '@' . $user->login . ' ' . __('books') }}</x-h>
    @endif

    @foreach ($books as $book)
      <hr class="mx-auto my-12 h-[1px] w-full text-surface-1" />
      <x-books.card
        :id="$book['id']"
        :user="$user"
        :userId="$book['userId']"
        :typeId="$book['typeId']"
        :title="$book['title']"
        :type="$book['type']"
        :author="$book['author']"
        :login="$book['login']"
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
