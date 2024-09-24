@props([
  'top_covers' => [],
  'latest_covers' => [],
])

@section('scripts')
  @vite(['resources/js/slider.js'])
@endsection

<x-app-layout>
  <x-section.hero />
  <x-section.slider-covers label="Top titles" sliderId="swiper1" :covers="$top_covers" />
  <x-section.slider-covers label="Latest titles" sliderId="swiper2" :covers="$latest_covers" />
  <x-section.features />
  <x-section.footer-cta />
</x-app-layout>
