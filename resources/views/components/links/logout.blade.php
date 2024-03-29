<form
  {{
    $attributes->merge([
      'class' => 'block',
    ])
  }}
  method="POST"
  action="{{ route('logout') }}"
>
  @csrf
  <button class="block align-top leading-[1.15]" type="submit">
    <x-p>{{ __('Logout') }}</x-p>
  </button>
</form>
