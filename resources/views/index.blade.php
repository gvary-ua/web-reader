<x-app-layout>
  <x-section.hero class="px-4 py-10 sm:px-10 md:px-14 lg:px-16" />

  <x-h level="h3" class="mt-20 px-4 py-10 text-center sm:px-10 md:px-14 lg:px-16">Скоро буде більше!</x-h>

  <form method="POST" action="{{ route('logout') }}">
    @csrf

    <x-button type="submit" variant="secondary" size="base">
      {{ __('Log Out') }}
    </x-button>
  </form>
</x-app-layout>
