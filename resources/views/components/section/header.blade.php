<header
  class="flex h-14 w-full items-center justify-between bg-secondary-1 px-4 py-4 sm:px-10 md:h-[4.25rem] md:px-14 lg:px-16"
>
  <a class="h-full" href="{{ url('/') }}"><x-logo class="h-full" withText /></a>

  <div x-data="{ open: false }">
    @auth
      <!-- For mobile -->
      <div class="md:hidden">
        <div class="relative flex items-center space-x-4 lg:space-x-12">
          <x-lang-selector />
          <img src="/icons/burger.svg" alt="Burger menu" class="h-full cursor-pointer" x-on:click="open = !open" />
        </div>
        <!-- Dropdown menu -->
        <div
          class="fixed bottom-0 left-0 top-0 z-50 min-h-full min-w-full overflow-y-auto overflow-x-hidden bg-background"
          x-cloak
          x-show="open"
        >
          <!-- Sticky header h-14 -->
          <div class="fixed left-0 top-0 flex h-14 w-full items-center justify-end bg-secondary-1 px-4 py-4 sm:px-10">
            <img src="/icons/close.svg" alt="Close menu" class="h-full cursor-pointer" x-on:click="open = !open" />
          </div>
          <div class="mt-14 px-4 py-8">
            @yield('header.mobile-dropdown-menu.before')
            <x-links.about-us class="border-b border-b-surface-1 py-4" />
            <x-links.my-profile class="border-b border-b-surface-1 py-4" />
            <x-links.my-books class="border-b border-b-surface-1 py-4" />
            <x-links.write-book class="border-b border-b-surface-1 py-4" />
            <x-links.write-verse class="border-b border-b-surface-1 py-4" />
            <x-links.logout class="border-b border-b-surface-1 py-4" />
            @yield('header.mobile-dropdown-menu.after')
          </div>
        </div>
      </div>
      <!-- For desktop -->
      <div class="relative hidden items-center space-x-4 md:flex lg:space-x-12">
        <x-links.about-us />
        <x-links.my-books />
        <x-links.write-book />
        <x-links.write-verse />
        <x-lang-selector />
        <div class="flex cursor-pointer flex-row items-center px-4 py-2" x-on:click="open = !open">
          <img src="/icons/user.svg" alt="User" class="h-full w-6 pr-1" />
          <span class="font-robotoFlex text-sm font-medium leading-4">{{ Auth::user()->login }}</span>
        </div>
        <!-- Dropdown menu -->
        <div
          class="absolute right-0 top-[calc(100%+6px)] z-50 whitespace-nowrap rounded-[4px] bg-background p-1 shadow-[0px_0px_8px_0px_#00000014,0px_8px_32px_0px_#00114D29]"
          x-cloak
          x-show="open"
          @click.outside="open = false"
        >
          <x-links.my-profile class="px-2 py-1" />
          <x-links.logout class="px-2 py-1" />
        </div>
      </div>
    @endauth

    @guest
      <div class="relative flex items-center space-x-4 lg:space-x-12">
        <x-lang-selector />
        <x-button class="sm:hidden" href="{{ route('login') }}" variant="primary" size="sm">
          {{ __('Sign in') }}
        </x-button>
        <x-button class="hidden sm:block" href="{{ route('login') }}" variant="primary" size="base">
          {{ __('Sign in') }}
        </x-button>
      </div>
    @endguest
  </div>
</header>
