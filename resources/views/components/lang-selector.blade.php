<div class="flex items-center justify-center space-x-2">
  @foreach ($supported_locales as $supported_locale)
    @if ($supported_locale === $current_locale)
      <x-p class="text-on-background-2">{{ strtoupper($supported_locale) }}</x-p>
    @else
      <a class="underline" href="{{ route('language.show', ['locale' => $supported_locale]) }}">
        <x-p>{{ strtoupper($supported_locale) }}</x-p>
      </a>
    @endif
  @endforeach
</div>
