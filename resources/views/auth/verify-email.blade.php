<x-guest-layout>
  <div class="mx-auto max-w-96 p-8 text-center text-on-background-1">
    <x-p class="mt-2" size="2xl">Дякуюмо за реєстрацію до</x-p>
    <a class="mx-auto inline-block cursor-pointer" href="{{ url('/') }}"><x-logo withText /></a>
    <x-p class="mt-2" size="base">Ми надіслали вам листа для підтвердження на електронну пошту.</x-p>
  </div>

  <div class="m-auto max-w-96 rounded-lg p-8">
    <form method="POST" action="{{ route('verification.send') }}">
      @csrf

      <div>
        <x-button type="submit" variant="primary" size="base" class="mx-auto">
          {{ __('Повторно відправити листа') }}
        </x-button>
      </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
      @csrf

      <x-button type="submit" variant="secondary-2" size="base" class="mx-auto mt-2">
        {{ __('Вийти') }}
      </x-button>
    </form>
  </div>
  <div class="p-2"></div>
</x-guest-layout>
