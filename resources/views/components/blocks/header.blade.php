@props([
  'data',
])

@php
  $level = [
    1 => 'h3',
    2 => 'h4',
    3 => 'h5',
  ]
@endphp

{{-- Class styles are from web-editor (.ce-header) --}}
<x-h level="{{$level[$data->level]}}" class="pb-[3px] pt-[.6em] leading-[1.25em]">{!! $data->text !!}</x-h>
