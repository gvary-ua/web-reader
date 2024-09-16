@props([
  'name',
  'label' => '',
  'items' => [],
])

<div {{ $attributes }}>
  <x-p class="mb-2" size="lg">{{ __($label) }}</x-p>
  <div class="max-h-full overflow-y-auto">
    @foreach ($items as $item)
      <x-checkbox :name="$name" :label="$item['label']" :value="$item['value']" :checked="$item['checked']" />
    @endforeach
  </div>
</div>
