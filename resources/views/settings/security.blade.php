<x-app-layout>
  <x-settings.layout :user="$user">
    <!-- Notification for mobile -->
    <x-notification type="success" class="mb-2 text-center md:hidden" />

    <form class="space-y-4 md:space-y-8" method="POST" action="{{ route('password.update') }}">
      @method('PUT')
      @csrf

      <x-input
        class="mt-4"
        id="current_password"
        type="password"
        label="Current password:"
        autocomplete="current_password"
        name="current_password"
        required
        :messages="$errors->updatePassword->get('current_password')"
      />

      <x-input
        class="mt-4"
        id="password"
        type="password"
        label="New password:"
        autocomplete="password"
        name="password"
        required
        :messages="$errors->updatePassword->get('password')"
      />

      <x-input
        class="mt-4"
        id="password_confirmation"
        type="password"
        label="Confirm password:"
        autocomplete="new-password"
        name="password_confirmation"
        required
        :messages="$errors->updatePassword->get('password_confirmation')"
      />

      <x-button class="w-full md:w-fit" type="submit" variant="primary" size="base">
        {{ __('Reset Password') }}
      </x-button>
    </form>

    <!-- Notification for desktop -->
    <x-notification type="success" class="mt-2 hidden md:block" />
  </x-settings.layout>
</x-app-layout>
