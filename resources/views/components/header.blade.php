<header
  class="min flex h-14 w-full items-center justify-between bg-secondary-1 px-4 py-4 sm:px-10 md:h-[4.25rem] md:px-14 lg:px-16"
>
  <x-logo withText class="h-full cursor-pointer" />
  <div>
    <!-- TODO: Fetch name and logo if authenticated-->
    @auth
      <!-- For mobile -->
      <img src="/icons/burger.svg" alt="Burger menu" class="h-full cursor-pointer md:hidden" />

      <!-- For desktop -->
      <div class="relative" x-data="{ open: false }">
        <div class="hidden cursor-pointer flex-row items-center md:flex" x-on:click="open = !open">
          <img src="/icons/user.svg" alt="User" class="h-full w-6 pr-1" />
          <span class="font-robotoFlex text-sm font-medium leading-4">{{ Auth::user()->login }}</span>
        </div>
        <!-- Dropdown menu -->
        <div
          class="absolute left-1/2 top-[calc(100%+6px)] z-50 -translate-x-1/2 whitespace-nowrap rounded-[4px] bg-background p-1 shadow-[0px_0px_8px_0px_#00000014,0px_8px_32px_0px_#00114D29]"
          x-show="open"
          @click.outside="open = false"
        >
          <a class="block px-2 py-1" href="{{ route('profile.index') }}">
            <x-p>{{ __('My profile') }}</x-p>
          </a>
          <form class="block px-2 py-1" method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="block align-top leading-[1.15]" type="submit">
              <x-p>{{ __('Logout') }}</x-p>
            </button>
          </form>
        </div>
      </div>
    @endauth

    @guest
      <x-button class="sm:hidden" href="{{ route('login') }}" variant="primary" size="sm">Увійти</x-button>
      <x-button class="hidden sm:block" href="{{ route('login') }}" variant="primary" size="base">Увійти</x-button>
    @endguest
  </div>
</header>
