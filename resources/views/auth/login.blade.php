<x-guest-layout>
  <div class="m-auto mt-3 max-w-96 p-8 text-on-background-1">
    <a href="{{ url('/') }}"><x-logo class="m-auto" /></a>
    <x-p class="mt-2 text-center" size="2xl">{{ __('Sign into Gvary') }}</x-p>
  </div>

  <div class="m-auto mt-5 max-w-96 rounded-lg p-8 sm:shadow-[2px_2px_10px_0px_#00000040]">
    <form method="POST" action="{{ route('login') }}">
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
        class="mt-6"
        id="password"
        type="password"
        label="Password:"
        autocomplete="current-password"
        name="password"
        required
        :messages="$errors->get('password')"
      />

      <a href="{{ route('password.request') }}">
        <x-p size="base" class="mt-5 text-right text-warning">{{ __('Forgot your password?') }}</x-p>
      </a>

      <x-button class="mt-14 w-full" type="submit" variant="primary" size="base">{{ __('Sign in') }}</x-button>

      <x-p class="mt-4 text-center text-success">{{ session('status') }}</x-p>
    </form>

    <div class="mt-5 text-center">
      <x-p size="base" class="text-on-background-1">{{ __('Don\'t have an account?') }}</x-p>
      <a href="{{ route('register') }}">
        <x-p size="base" class="mt-1 text-warning">{{ __('Sign up') }}</x-p>
      </a>
    </div>
  </div>
</x-guest-layout>
