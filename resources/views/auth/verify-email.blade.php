<x-guest-layout>
  <div class="mx-auto max-w-96 p-8 text-center text-on-background-1">
    <x-p class="mt-2" size="2xl">{{ __('Thank you for joining') }}</x-p>
    <a class="mx-auto inline-block" href="{{ url('/') }}"><x-logo withText /></a>
    <x-p class="mt-2" size="base">
      {{ __('We have sent you a confirmation email.') }}
    </x-p>
  </div>

  <div class="m-auto max-w-96 rounded-lg p-8">
    <form method="POST" action="{{ route('verification.send') }}">
      @csrf

      <div>
        <x-button type="submit" variant="primary" size="base" class="mx-auto">
          {{ __('Resend the email') }}
        </x-button>
      </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
      @csrf

      <x-button type="submit" variant="secondary-2" size="base" class="mx-auto mt-2">
        {{ __('Sign out') }}
      </x-button>
    </form>
  </div>
  <div class="p-2"></div>
</x-guest-layout>
