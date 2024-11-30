@props([
  'top_covers' => [],
  'latest_covers' => [],
  'cover_count' => 0,
])

@section('scripts')
  @vite(['resources/js/slider.js'])
@endsection

<x-app-layout>
  <x-section.hero />
  <x-section.slider-covers label="Top titles" sliderId="swiper1" :covers="$top_covers" />
  <x-section.explore :cover_count="$cover_count" />
  <x-section.features />
  <x-section.footer-cta />
</x-app-layout>
