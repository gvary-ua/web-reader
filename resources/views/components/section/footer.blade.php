<footer class="bg-surface-1 px-4 py-14 sm:px-20 sm:pb-9 sm:pt-16">
  <a class="h-full" href="{{ url('/') }}"><x-logo class="h-full" withText /></a>
  <div class="mt-12 flex flex-wrap justify-between gap-12 sm:mt-8">
    <ul class="max-w-80 space-y-[10px]">
      <li>
        <x-p size="sm">{{ __('Gvary is the community of writers and readers') }}.</x-p>
      </li>
      <li>
        <x-p size="sm"><a href="{{ route('explore') }}">{{ __('Discover') }}</a></x-p>
      </li>
      <li>
        <x-p size="sm"><a href="/about">{{ __('About us') }}</a></x-p>
      </li>
    </ul>
    <ul class="max-w-80 space-y-[10px]">
      <li>
        <x-p size="sm">{{ __('If you need help or feature request') }}:</x-p>
        <x-p size="sm">help.gvary@s1ckret.com</x-p>
      </li>
      <li>
        <x-p size="sm">{{ __('Report a bug') }}:</x-p>
        <x-p size="sm">bug.gvary@s1ckret.com</x-p>
      </li>
    </ul>
    <ul class="max-w-80 space-y-[10px] text-warning">
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
    <a href="/">{{ __('Privacy Policy') }} {{ __('Gvary') }}</a>
    &#169;2024
  </x-p>
</footer>
