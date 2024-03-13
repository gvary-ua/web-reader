<x-app-layout>
  <x-slot name="header">
    <h2 class="text-gray-800 dark:text-gray-200 text-xl font-semibold leading-tight">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="text-gray-900 dark:text-gray-100 p-6">
          {{ __("You're logged in!") }}
        </div>
      </div>
    </div>
  </div>
</x-app-layout>
