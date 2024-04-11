<a href="/">
  @if ($attributes->has('withText'))
    <img {{ $attributes }} src="/icons/logo-text.svg" alt="Logo svg" />
  @else
    <img {{ $attributes }} src="/icons/logo.svg" alt="Logo svg" />
  @endif
</a>
