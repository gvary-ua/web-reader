<x-app-layout>
  <x-settings.layout :user="$user">
    <!-- Notification for mobile -->
    <x-notification type="success" class="mb-2 text-center md:hidden" />

    <form
      class="space-y-4 md:space-y-8"
      method="POST"
      action="{{ route('settings.profile.update', ['user' => $user]) }}"
    >
      @method('PUT')
      <x-input
        type="text"
        value="{{ $user->pen_name }}"
        autofocus
        name="pen_name"
        id="pen_name"
        label="Pen name:"
        :messages="$errors->get('pen_name')"
      />

      <x-input
        type="text"
        value="{{ $user->first_name }}"
        name="first_name"
        id="first_name"
        label="First name:"
        :messages="$errors->get('first_name')"
      />

      <x-input
        type="text"
        value="{{ $user->last_name }}"
        name="last_name"
        id="last_name"
        label="Last name:"
        :messages="$errors->get('last_name')"
      />

      @csrf
      <x-button class="w-full md:w-fit" type="submit" variant="primary" size="base">{{ __('Save') }}</x-button>
    </form>
    <!-- Notification for desktop -->
    <x-notification type="success" class="mt-2 hidden md:block" />
  </x-settings.layout>
</x-app-layout>
