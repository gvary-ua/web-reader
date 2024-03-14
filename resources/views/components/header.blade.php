<header class="min flex h-14 w-full items-center justify-between bg-secondary-1 px-4 py-4 md:h-[4.25rem] md:px-20">
  <x-logo withText class="h-full cursor-pointer" />
  <div>
    <img src="/icons/burger.svg" alt="Burger menu" class="h-full cursor-pointer md:hidden" />

    <div class="hidden cursor-pointer flex-row items-center md:flex">
      <!-- TODO: Fetch name and logo if authenticated-->
      @auth
        <img src="/icons/user.svg" alt="User" class="h-full w-6 cursor-pointer pr-1" />
        <span class="font-robotoFlex text-sm font-medium leading-4">username</span>
      @endauth

      @guest
        <x-button variant="primary" size="base">Увійти</x-button>
      @endguest
    </div>
  </div>
</header>
