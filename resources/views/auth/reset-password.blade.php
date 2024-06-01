<x-guest-layout>
  <div class="m-auto mt-3 max-w-96 p-8 text-on-background-1">
    <a href="{{ url('/') }}"><x-logo class="m-auto" /></a>
    <x-p class="mt-2 text-center" size="2xl">{{ __('Reset Password') }}</x-p>
  </div>

  <div class="m-auto max-w-96 rounded-lg p-8 sm:shadow-[2px_2px_10px_0px_#00000040]">
    <form method="POST" action="{{ route('password.store') }}">
      @csrf

      <input type="hidden" name="token" value="{{ $request->route('token') }}" />

      <x-input
        type="email"
        required
        autofocus
        autocomplete="email"
        name="email"
        id="email"
        label="Email:"
        :value="old('email', $request->email)"
        :messages="$errors->get('email')"
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

      <x-button class="mt-14 w-full" type="submit" variant="primary" size="base">
        {{ __('Reset Password') }}
      </x-button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
      @csrf

      <x-button class="mt-2 w-full" type="submit" variant="secondary-2" size="base">
        {{ __('Sign out') }}
      </x-button>
    </form>
  </div>
  <div class="p-2"></div>
</x-guest-layout>
