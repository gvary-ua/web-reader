@props([
  'id',
  'user',
  'title',
  'type',
  'imgSrc' => asset('blank-224X320.webp'),
])

<div {{ $attributes->merge(['class' => implode(' ', ['min-w-48 max-w-48 md:min-w-80 md:max-w-80'])]) }}>
  <a href="{{ route('books.show', ['book' => $id]) }}">
    <div class="relative">
      <img
        width="100%"
        height="100%"
        class="max-h-72 min-h-72 min-w-48 max-w-48 rounded-lg object-cover md:max-h-96 md:min-h-96 md:min-w-80 md:max-w-80"
        src="{{ $imgSrc }}"
      />
      <x-badge size="sm" class="absolute bottom-2 left-2 bg-surface-1" type="square">{{ __($type) }}</x-badge>
    </div>
    <x-p class="mt-2 font-medium" size="2xl">{{ $title }}</x-p>
  </a>
  <a href="{{ route('profile.show', ['user' => $user->user_id]) }}">
    <x-p class="mt-2 text-on-background-2" size="base">{{ $user->displayName() }}</x-p>
  </a>
</div>
