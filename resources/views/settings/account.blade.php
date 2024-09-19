@php
  $supportedLocales = config('app.SUPPORTED_LOCALES');
  $languages = array_map(function ($locale) {
    return [
      'value' => $locale,
      'label' => $locale,
      'selected' => $locale == session('locale'),
    ];
  }, $supportedLocales);
@endphp

<x-app-layout>
  <x-settings.layout :user="$user">
    <!-- Notification for mobile -->
    <x-notification type="success" class="mb-2 text-center md:hidden" />

    <form class="space-y-4 md:space-y-8" method="POST" action="{{ route('language.update') }}">
      @csrf
      @method('PUT')
      <x-select name="locale" label="{{__('Language')}}:" :items="$languages" class="mt-12"></x-select>

      <x-button class="w-full md:w-fit" type="submit" variant="primary" size="base">{{ __('Save') }}</x-button>
    </form>
    <!-- Notification for desktop -->
    <x-notification type="success" class="mt-2 hidden md:block" />
  </x-settings.layout>
</x-app-layout>
