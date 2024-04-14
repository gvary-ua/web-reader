<x-guest-layout>
  <div class="mx-auto flex max-w-96 items-end justify-center p-8 text-on-background-1">
    <x-p class="mt-2 text-center" size="2xl">{{ __('Sign up to') }}</x-p>
    <a href="{{ url('/') }}"><x-logo withText class="ml-2" /></a>
  </div>

  <div class="m-auto max-w-96 rounded-lg p-8 sm:shadow-[2px_2px_10px_0px_#00000040]">
    <form method="POST" action="{{ route('register') }}">
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
      />

      <x-input
        class="mt-4"
        type="text"
        required
        autocomplete="login"
        name="login"
        id="login"
        label="Username:"
        :messages="$errors->get('login')"
      />

      <x-input
        class="mt-4"
        id="password"
        type="password"
        label="Password:"
        autocomplete="new-password"
        name="password"
        required
        :messages="$errors->get('password')"
      />

      <x-input
        class="mt-4"
        id="password_confirmation"
        type="password"
        label="Confirm password:"
        autocomplete="new-password"
        name="password_confirmation"
        required
        :messages="$errors->get('password_confirmation')"
      />

      <x-p size="xs" class="mt-4">
        {{ __('By pressing the button') }}
        <i>{{ __('Sign up') }}</i>
        {{ __(', you are agreeing with ') }}
        <a href="/" class="text-warning">{{ __('Terms of use') }}</a>
        {{ __('and') }}
        <a href="/" class="text-warning">{{ __('Privacy policy') }}</a>
      </x-p>

      <x-button class="mt-4 w-full" type="submit" variant="primary" size="base">
        {{ __('Sign up') }}
      </x-button>
    </form>

    <div class="mt-4 text-center">
      <x-p size="base" class="text-on-background-1">{{ __('Already have an account?') }}</x-p>
      <a href="{{ route('login') }}">
        <x-p size="base" class="mt-1 text-warning">{{ __('Sign in') }}</x-p>
      </a>
    </div>
  </div>
  <div class="p-2"></div>
</x-guest-layout>
