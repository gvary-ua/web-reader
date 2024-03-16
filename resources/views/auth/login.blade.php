<x-guest-layout>
  @session('status')
    <div class="bg-green-100 p-4">
      {{ $value }}
    </div>
  @endsession

  <div class="m-auto mt-3 max-w-96 p-8 text-on-background-1">
    <a href="{{ url('/') }}"><x-logo class="m-auto cursor-pointer" /></a>
    <x-p class="mt-2 text-center" size="2xl">Вхід до Gvary</x-p>
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
        label="Пароль:"
        autocomplete="current-password"
        name="password"
        required
        :messages="$errors->get('password')"
      />

      <a href="{{ route('password.request') }}">
        <x-p size="base" class="mt-5 text-right text-warning">Забули пароль?</x-p>
      </a>

      <x-button class="mt-14 w-full" type="submit" variant="primary" size="base">Увійти</x-button>
    </form>

    <div class="mt-5 text-center">
      <x-p size="base" class="text-on-background-1">Ще не маєте аккаунта?</x-p>
      <a href="{{ route('register') }}">
        <x-p size="base" class="mt-1 text-warning">Зареєструватися</x-p>
      </a>
    </div>
  </div>
</x-guest-layout>
