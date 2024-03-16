<section
  {{
    $attributes->merge([
      'class' => 'relative bg-secondary-1 text-on-secondary-1 ',
    ])
  }}
>
  <x-h level="h1">Спільнота письменників</x-h>
  <x-h level="h2" class="font-bold">та читачів</x-h>
  <x-p size="2xl" class="mt-6 sm:mt-10">
    Занурюйся у всесвіт,
    <br class="sm:hidden" />
    де ти можеш писати та
    <br class="sm:hidden" />
    обговорювати
    <br class="hidden md:inline lg:hidden" />
    найкращі
    <br class="sm:hidden" />
    новели
    <br class="hidden lg:inline" />
    та романи, які варті
    <br class="sm:hidden" />
    твоєї уваги
  </x-p>
  <x-button href="{{route('register')}}" variant="primary" size="2xl" class="mt-12 w-full sm:w-fit">
    Доєднатися
  </x-button>
  <x-gvary-comment class="mb-[-5rem] mt-8" />
</section>
