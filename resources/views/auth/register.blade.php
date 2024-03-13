<x-guest-layout>
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Login -->
    <div>
      <x-input-label for="login" :value="__('Login')" />
      <x-text-input
        id="login"
        class="mt-1 block w-full"
        type="text"
        name="login"
        :value="old('login')"
        required
        autofocus
        autocomplete="login"
      />
      <x-input-error :messages="$errors->get('login')" class="mt-2" />
    </div>

    <!-- First Name -->
    <div class="mt-4">
      <x-input-label for="first_name" :value="__('First Name')" />
      <x-text-input
        id="first_name"
        class="mt-1 block w-full"
        type="text"
        name="first_name"
        :value="old('first_name')"
        required
        autocomplete="first_name"
      />
      <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
    </div>

    <!-- Last Name -->
    <div class="mt-4">
      <x-input-label for="last_name" :value="__('Last Name')" />
      <x-text-input
        id="last_name"
        class="mt-1 block w-full"
        type="text"
        name="last_name"
        :value="old('last_name')"
        required
        autocomplete="last_name"
      />
      <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
    </div>

    <!-- Pen Name -->
    <div class="mt-4">
      <x-input-label for="pen_name" :value="__('Pen Name')" />
      <x-text-input
        id="pen_name"
        class="mt-1 block w-full"
        type="text"
        name="pen_name"
        :value="old('pen_name')"
        autocomplete="pen_name"
      />
      <x-input-error :messages="$errors->get('pen_name')" class="mt-2" />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input
        id="email"
        class="mt-1 block w-full"
        type="email"
        name="email"
        :value="old('email')"
        required
        autocomplete="username"
      />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" />

      <x-text-input
        id="password"
        class="mt-1 block w-full"
        type="password"
        name="password"
        required
        autocomplete="new-password"
      />

      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
      <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

      <x-text-input
        id="password_confirmation"
        class="mt-1 block w-full"
        type="password"
        name="password_confirmation"
        required
        autocomplete="new-password"
      />

      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="mt-4 flex items-center justify-end">
      <a
        class="text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 rounded-md text-sm underline focus:outline-none focus:ring-2 focus:ring-offset-2"
        href="{{ route('login') }}"
      >
        {{ __('Already registered?') }}
      </a>

      <x-primary-button class="ms-4">
        {{ __('Register') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>
