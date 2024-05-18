<section class="px-4 py-14 sm:px-20 sm:py-32">
  <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
    <div class="rounded-2xl bg-surface-1 p-9 px-5 sm:px-8 lg:col-span-2">
      <x-h class="hidden sm:block" level="h3">{{ __('Do you love to read or dream of becoming a writer?') }}</x-h>
      <x-h class="hidden text-warning sm:block" level="h3">{{ __('We will help you!') }}</x-h>
      <x-h class="sm:hidden" level="h4">{{ __('Do you love to read or dream of becoming a writer?') }}</x-h>
      <x-h class="text-warning sm:hidden" level="h4">{{ __('We will help you!') }}</x-h>
    </div>
    <div class="hidden items-center rounded-2xl bg-warning p-9 px-5 sm:px-8 lg:flex">
      <x-logo class="m-auto scale-150" withText />
    </div>
    <div class="rounded-2xl bg-surface-info p-9 px-5 sm:px-8">
      <x-h class="mb-8 font-semibold sm:mb-20" level="h4">{{ __('Grow') }}</x-h>
      <x-p size="lg">
        {{ __('Educational materials and writing competitions to help you improve your skills') }}
      </x-p>
    </div>
    <div class="rounded-2xl bg-secondary-1 p-9 px-5 sm:px-8">
      <x-h class="mb-8 font-semibold sm:mb-20" level="h4">{{ __('Monetise') }}</x-h>
      <x-p size="lg">
        {{ __('The platform\'s algorithms provide promotion, and it is possible to support the author with donations') }}
      </x-p>
    </div>
    <div class="rounded-2xl bg-surface-error p-9 px-5 sm:px-8">
      <x-h class="mb-8 font-semibold sm:mb-20" level="h4">{{ __('Network') }}</x-h>
      <x-p size="lg">
        {{ __('A platform for like-minded people, support and reasonable criticism') }}
      </x-p>
    </div>
  </div>
</section>
