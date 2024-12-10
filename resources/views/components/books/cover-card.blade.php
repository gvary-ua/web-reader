@props([
  'id',
  'user',
  'title',
  'type',
  'imgSrc',
])

<div
  {{ $attributes->merge(['class' => implode(' ', ['max-w-[128px] md:max-w-[192px] lg:max-w-[288px]'])]) }}
>
  <a href="{{ route('books.show', ['book' => $id]) }}">
    <div class="relative">
      <img
        width="100%"
        height="100%"
        class="max-h-[192px] max-w-[128px] rounded-lg object-cover md:max-h-[288px] md:max-w-[192px] lg:max-h-[432px] lg:max-w-[288px]"
        src="{{ asset($imgSrc ? 'storage/public/' . $imgSrc : 'blank-224X320.webp') }}"
      />
      <x-badge size="sm" class="absolute bottom-2 left-2 bg-surface-1" type="square">{{ __($type) }}</x-badge>
    </div>
    <x-p class="mt-2 font-medium" size="2xl">{{ $title }}</x-p>
  </a>
  <a href="{{ route('profile.show', ['user' => $user->user_id]) }}">
    <x-p class="mt-2 text-on-background-2" size="base">{{ $user->displayName() }}</x-p>
  </a>
</div>
