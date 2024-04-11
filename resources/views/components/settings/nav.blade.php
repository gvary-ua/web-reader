@props([
  'user',
])

<nav {{ $attributes }}>
  <x-h class="text-center md:text-left" level="h5">{{ __('Settings') }}</x-h>
  <ul class="mt-6 min-w-72 space-y-4">
    <x-settings.nav-element :user="$user" route="settings.profile" label="Profile" />
    <x-settings.nav-element :user="$user" route="settings.account" label="Account" />
    <x-settings.nav-element :user="$user" route="settings.security" label="Security" />
  </ul>
</nav>
