@props([
  'top_covers' => [],
  'latest_covers' => [],
])

@section('scripts')
  @vite(['resources/js/slider.js'])
@endsection

<x-app-layout>
  <x-section.hero />
  <section class="mb-10 mt-20 px-4 sm:my-32 sm:px-20">
    <div class="flex justify-between">
      <x-h level="h3">{{ __('Top titles') }}</x-h>
      <div class="hidden space-x-8 md:flex">
        <img class="cursor-pointer" src="/icons/arrow-left-big.svg" alt="scroll left" onclick="swiper1.slidePrev()" />
        <img class="cursor-pointer" src="/icons/arrow-right-big.svg" alt="scroll right" onclick="swiper1.slideNext()" />
      </div>
    </div>
    <div class="swiper1 relative mt-8 pb-12 md:mt-14 md:pb-0">
      <div class="swiper-wrapper">
        @foreach ($top_covers as $cover)
          <hr class="mx-auto my-12 h-[1px] w-full text-surface-1" />
          <x-books.cover-card
            class="swiper-slide"
            :id="$cover['id']"
            :userId="$cover['user_id']"
            :title="$cover['title']"
            :type="$cover['type']"
            :author="$cover['author']"
            :imgSrc="$cover['imgSrc']"
          />
        @endforeach
      </div>
      <div class="swiper-pagination md:hidden"></div>
    </div>
  </section>
  <section class="my-10 px-4 sm:my-32 sm:px-20">
    <div class="hidden justify-between md:flex">
      <x-h level="h3">{{ __('Latest titles') }}</x-h>
      <div class="flex space-x-8">
        <img class="cursor-pointer" src="/icons/arrow-left-big.svg" alt="scroll left" onclick="swiper2.slidePrev()" />
        <img class="cursor-pointer" src="/icons/arrow-right-big.svg" alt="scroll right" onclick="swiper2.slideNext()" />
      </div>
    </div>
    <div class="swiper2 relative mt-8 pb-12 md:mt-14 md:pb-0">
      <div class="swiper-wrapper">
        @foreach ($latest_covers as $cover)
          <hr class="mx-auto my-12 h-[1px] w-full text-surface-1" />
          <x-books.cover-card
            class="swiper-slide"
            :id="$cover['id']"
            :userId="$cover['user_id']"
            :title="$cover['title']"
            :type="$cover['type']"
            :author="$cover['author']"
            :imgSrc="$cover['imgSrc']"
          />
        @endforeach
      </div>
      <div class="swiper-pagination md:hidden"></div>
    </div>
  </section>
  <x-section.features />
  <x-section.footer-cta />
</x-app-layout>
