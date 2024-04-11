<x-app-layout>
  <section class="min-h-36 bg-secondary-1 md:min-h-52"></section>
  <section class="max-w-[50rem] px-4 sm:flex md:mx-auto">
    <img
      src="/icons/user.svg"
      alt="{{ $user->login }}"
      class="mx-auto -mt-28 h-44 w-44 rounded-full border-4 border-background sm:mx-0 sm:-mt-16"
    />
    <div class="mt-2 flex flex-grow justify-between sm:ml-4 sm:mt-4 md:ml-8">
      <span>
        @if ($user->first_name || $user->last_name)
          <x-p size="2xl">{{ $user->first_name }} {{ $user->last_name }}</x-p>
        @endif

        @if ($user->login)
          <x-p size="base" class="on-background-2">&commat;{{ $user->login }}</x-p>
        @endif
      </span>
      <span>
        <!-- Desktop button -->
        <x-button
          class="hidden sm:flex"
          size="xs"
          icon="/icons/edit-white.svg"
          iconPosition="right"
          href="{{ route('settings.profile', ['user' => $user]) }}"
        >
          <x-p size="base">{{ __('Edit') }}</x-p>
        </x-button>
        <!-- Mobile button -->
        <x-button
          class="sm:hidden"
          size="xs"
          icon="/icons/edit-white.svg"
          href="{{ route('settings.profile', ['user' => $user]) }}"
        ></x-button>
      </span>
    </div>
  </section>
  <section>
    <x-p class="mt-36 text-center">{{ __('More to come soon!') }}</x-p>
  </section>
</x-app-layout>
