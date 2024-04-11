@props([
  'id',
  'type' => 'text',
  'icon' => null,
  'label' => null,
  'messages' => [],
])

@php
  $inputClasses = 'mr-2 w-full rounded-lg bg-surface-2 bg-surface-2 px-4 pr-12 font-robotoFlex font-normal outline-none';
  $inputErrorClasses = '';
  if ($messages) {
    $icon = '/icons/union.svg';
    $inputErrorClasses = 'border-error';
  }
  $passwordField = 'false';
  if ($type === 'password') {
    $icon = '/icons/eye-hide.svg';
    $passwordField = 'true';
  }
  // Apply external classes to the root div
  $class = $attributes['class'];
  unset($attributes['class']);
@endphp

<div class="{{ $class }}">
  @if ($label)
    <label for="{{ $id }}">
      <x-p class="mb-2" size="lg">{{ __($label) }}</x-p>
    </label>
  @endif

  <div
    class="relative"
    x-data="{
      passwordField: {{ $passwordField }},
      type: '{{ $type }}',
      show: false,
      src: '{{ $icon }}',
    }"
  >
    <input
      {{
        $attributes->merge([
          'id' => $id,
          'type' => $type,
          'class' => implode(' ', [$inputClasses, $inputErrorClasses]),
        ])
      }}
      {{-- This bind is only needed for 'password' type inputs to hide/show password --}}
      :type="type"
    />
    @if ($icon)
      <img
        class="absolute right-4 top-1/2 h-5 w-5 -translate-y-1/2 transform"
        src="{{ $icon }}"
        alt="icon"
        {{-- This bind is only needed for 'password' type inputs to change icons --}}
        :src="src"
        @click="
            {{-- Only switch icons for password input type --}}
            if (!passwordField) return;
            show ? type = 'password' : type = 'text';
            show ? src = '/icons/eye-hide.svg' : src = '/icons/eye-show.svg';
            show = !show;
        "
      />
    @endif
  </div>

  @if ($messages)
    <ul class="mt-2 space-y-1 pl-2 text-error">
      @foreach ((array) $messages as $message)
        <li>
          <x-p size="base">{{ $message }}</x-p>
        </li>
      @endforeach
    </ul>
  @endif
</div>
