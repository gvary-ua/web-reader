@props([
  'bookId',
  'currChapterId',
  'chapters' => [],
])

<div {{
  $attributes->merge([
    'class' => '',
  ])
}}>
  <x-p size="lg" class="pb-5 font-medium">{{ __('Chapters') }}:</x-p>
  @foreach ($chapters as $chapter)
    <a href="{{ route('chapters.show', ['book' => $bookId, 'chapter' => $chapter->chapter_id]) }}">
      @if ($currChapterId === $chapter->chapter_id)
        <x-p size="base" class="mt-4">
          {{ $chapter->title }}
        </x-p>
      @else
        <x-p size="base" class="mt-4 text-secondary-2">
          {{ $chapter->title }}
        </x-p>
      @endif
    </a>
  @endforeach
</div>
