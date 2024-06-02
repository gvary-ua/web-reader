@props([
  'user',
])

<section class="after:invisible after:clear-both after:block after:leading-[0] after:content-['.']">
  <x-settings.nav :user="$user" class="px-4 pt-8 md:float-left md:ml-10 md:px-0 md:py-10 lg:ml-20"></x-settings.nav>
  <div class="after:h-0; px-4 py-8 md:float-left md:ml-9 md:px-0 md:py-10">
    {{ $slot }}
  </div>
</section>
