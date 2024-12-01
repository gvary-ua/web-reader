@props([
  'sliderId',
  'label',
  'href' => '',
  'covers' => [],
])

<x-section.slider :sliderId="$sliderId" :label="$label" :href="$href">
  @foreach ($covers as $cover)
    <x-books.cover-card
      class="swiper-slide"
      :id="$cover['id']"
      :user="$cover['user']"
      :title="$cover['title']"
      :type="$cover['type']"
      :imgSrc="$cover['imgSrc']"
    />
  @endforeach
</x-section.slider>
