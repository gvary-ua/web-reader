<x-guest-layout>
  <div class="mx-auto max-w-96 p-8 text-center text-on-background-1">
    <a class="mx-auto inline-block" href="{{ url('/') }}"><x-logo withText /></a>
    <x-p class="mt-2" size="2xl">{{ __('Forgot your password?') }}</x-p>
    <x-p class="mt-2" size="base">
      {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </x-p>
  </div>

  <div class="m-auto mt-5 max-w-96 rounded-lg p-8 sm:shadow-[2px_2px_10px_0px_#00000040]">
    <form method="POST" action="{{ route('password.email') }}">
      @csrf

      <x-input
        type="email"
        required
        autofocus
        autocomplete="email"
        name="email"
        id="email"
        label="Email:"
        :messages="$errors->get('email')"
        :value="old('email')"
      />

      <x-button class="mt-14 w-full" type="submit" variant="primary" size="base">
        {{ __('Email Password Reset Link') }}
      </x-button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
      @csrf

      <x-button class="mt-2 w-full" type="submit" variant="secondary-2" size="base">
        {{ __('Sign out') }}
      </x-button>
    </form>
    <x-p class="mt-4 text-success">{{ session('status') }}</x-p>
  </div>
</x-guest-layout>
