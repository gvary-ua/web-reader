@props([
  'user',
])

<section class="md:flex">
  <x-settings.nav :user="$user" class="px-4 pt-8 md:ml-10 md:px-0 md:py-10 lg:ml-20"></x-settings.nav>
  <div class="px-4 py-8 md:ml-9 md:px-0 md:py-10">
    {{ $slot }}
  </div>
</section>
