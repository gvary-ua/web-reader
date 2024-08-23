@props([
  'data',
])

{{-- Class styles are from web-editor --}}
@if ($data->style === 'ordered')
  <ol class="list-decimal py-[0.4em] pl-[40px]">
    @foreach ($data->items as $item)
      <li class="p-[5.5px_0_5.5px_3px] leading-[1.6em]">{!! $item !!}</li>
    @endforeach
  </ol>
@else
  <ul class="list-disc py-[0.4em] pl-[40px]">
    @foreach ($data->items as $item)
      <li class="p-[5.5px_0_5.5px_3px] leading-[1.6em]">{!! $item !!}</li>
    @endforeach
  </ul>
@endif
