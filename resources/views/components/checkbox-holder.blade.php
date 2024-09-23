@props([
  'name',
  'label' => '',
  'items' => [],
  'innerClass' => '',
])

<div {{ $attributes }}>
  <x-p class="mb-2" size="lg">{{ __($label) }}</x-p>
  <div class="{{ $innerClass }} overflow-y-auto">
    @foreach ($items as $item)
      <x-checkbox :name="$name" :label="$item['label']" :value="$item['value']" :checked="$item['checked']" />
    @endforeach
  </div>
</div>
