@props([
  'sliderId',
  'href' => '',
  'label' => '',
])

<section class="mb-10 mt-20 px-4 sm:my-32 sm:px-20">
  <div class="flex justify-between">
    <x-h level="h3">
      @if ($href)
        <a href="{{ $href }}">{{ __($label) }}</a>
      @else
        {{ __($label) }}
      @endif
    </x-h>
    <div class="hidden space-x-8 md:flex">
      <img
        class="cursor-pointer"
        src="/icons/arrow-left-big.svg"
        alt="scroll left"
        onclick="{{ $sliderId }}.slidePrev()"
      />
      <img
        class="cursor-pointer"
        src="/icons/arrow-right-big.svg"
        alt="scroll right"
        onclick="{{ $sliderId }}.slideNext()"
      />
    </div>
  </div>
  <hr class="mx-auto my-12 h-[1px] w-full text-surface-1" />
  <div class="{{ $sliderId }} relative mt-8 pb-12 md:mt-14 md:pb-0">
    <div class="swiper-wrapper">
      {{ $slot }}
    </div>
    <div class="swiper-pagination md:hidden"></div>
  </div>
</section>
