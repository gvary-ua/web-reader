@props([
  'data',
])

{{-- Class styles are from web-editor --}}
<x-p class="py-[0.4em] leading-[1.6em]">{!! $data->text !!}</x-p>
