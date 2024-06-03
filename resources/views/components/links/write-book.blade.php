<form
  {{
    $attributes->merge([
      'class' => 'block',
    ])
  }}
  method="POST"
  action="{{ route('profile.books.create', ['user' => Auth::user()]) }}"
>
  @csrf

  <input name="coverTypeId" type="hidden" value="1" />

  <button class="block align-top leading-[1.15]" type="submit">
    <x-p>{{ __('Write book') }}</x-p>
  </button>
</form>
