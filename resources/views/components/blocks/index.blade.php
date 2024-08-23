@props([
  'blocks' => [],
])

{{-- Class styles are from web-editor --}}
@foreach ($blocks as $block)
  @switch($block->block_type_id)
    @case(1)
      <x-blocks.header :data="$block->data" />

      @break
    @case(2)
      <x-blocks.paragraph :data="$block->data" />

      @break
    @case(3)
      <x-blocks.list :data="$block->data" />

      @break
    @case(4)
      <x-blocks.check-list :data="$block->data" />

      @break
    @case(5)
      <x-blocks.delimiter :data="$block->data" />

      @break
    @default
      <x-p class="text-error">
        We don't support this block type {{ $block->block_type_id }}! Block id: {{ $block->block_nanoid_10 }}
      </x-p>
  @endswitch
@endforeach
