<footer class="bg-surface-1 px-4 pb-14 pt-14 sm:px-20 sm:pb-9 sm:pt-16">
  <a class="h-full" href="{{ url('/') }}"><x-logo class="h-full" withText /></a>
  <div class="mt-12 flex flex-wrap justify-between gap-12 sm:mt-8">
    <ul class="space-y-[10px]">
      <li>
        <x-p size="sm"><a href="/">{{ __('Site rules') }}</a></x-p>
      </li>
      <li>
        <x-p size="sm"><a href="/">{{ __('User agreement') }}</a></x-p>
      </li>
      <li>
        <x-p size="sm"><a href="/">{{ __('Public offer agreement') }}</a></x-p>
      </li>
      <li>
        <x-p size="sm"><a href="/">{{ __('Advertise with us') }}</a></x-p>
      </li>
    </ul>
    <ul class="space-y-[10px]">
      <li>
        <x-p size="sm"><a href="/">{{ __('About us') }}</a></x-p>
      </li>
      <li>
        <x-p size="sm"><a href="/">{{ __('I\'m inspired') }}</a></x-p>
      </li>
      <li>
        <x-p size="sm"><a href="/">{{ __('I create') }}</a></x-p>
      </li>
      <li>
        <x-p size="sm"><a href="/">{{ __('Payment') }}</a></x-p>
      </li>
    </ul>
    <ul class="space-y-[10px]">
      <li>
        <x-p size="sm"><a href="/">{{ __('contact@gvary.com') }}</a></x-p>
      </li>
      <li>
        <x-p size="sm"><a href="/">{{ __('Facebook') }}</a></x-p>
      </li>
      <li>
        <x-p size="sm"><a href="/">{{ __('Instagram') }}</a></x-p>
      </li>
      <li>
        <x-p size="sm"><a href="/">{{ __('TikTok') }}</a></x-p>
      </li>
    </ul>
    <ul class="space-y-[10px] text-warning">
      <li>
        <x-p size="sm">{{ __('The copyright on works belongs to the authors and is protected by law') }}</x-p>
      </li>
      <li>
        <x-p size="sm">
          {{ __('The site may contain materials not intended for viewing by persons under 18 years of age!') }}
        </x-p>
      </li>
    </ul>
  </div>
  <x-p class="mt-20 sm:mt-14" size="sm">
    <a href="/">{{ __('Privacy Policy') }}</a>
    &#169;2024
  </x-p>
</footer>
