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
      :userId="$cover['user_id']"
      :title="$cover['title']"
      :type="$cover['type']"
      :author="$cover['author']"
      :imgSrc="$cover['imgSrc']"
    />
  @endforeach
</x-section.slider>
