<x-guest-layout>
  <div class="mx-auto flex max-w-96 items-end justify-center p-8 text-on-background-1">
    <x-p class="mt-2 text-center" size="2xl">Реєстрація до</x-p>
    <a href="{{ url('/') }}"><x-logo withText class="ml-2 cursor-pointer" /></a>
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
        label="Пароль:"
        autocomplete="new-password"
        name="password"
        required
        :messages="$errors->get('password')"
      />

      <x-input
        class="mt-4"
        id="password_confirmation"
        type="password"
        label="Підтвердіть пароль:"
        autocomplete="new-password"
        name="password_confirmation"
        required
        :messages="$errors->get('password_confirmation')"
      />

      <x-p size="xs" class="mt-4">
        Натискаючи кнопку
        <i>Зареєструватися</i>
        , Ви погоджуєтеся з умовами
        <a href="/" class="text-warning">Угоди користування</a>
        та
        <a href="/" class="text-warning">Політики конфіденційності</a>
      </x-p>

      <x-button class="mt-4 w-full" type="submit" variant="primary" size="base">Зареєструватися</x-button>
    </form>

    <div class="mt-4 text-center">
      <x-p size="base" class="text-on-background-1">Вже маєте аккаунт?</x-p>
      <a href="{{ route('login') }}">
        <x-p size="base" class="mt-1 text-warning">Увійти</x-p>
      </a>
    </div>
  </div>
  <div class="p-2"></div>
</x-guest-layout>
