@props([
  'url',
])
<tr>
  <td class="header">
    <a href="{{ $url }}" style="display: inline-block">
      <img src="{{ asset('/icons/logo.svg') }}" class="logo" alt="Laravel Logo" />
    </a>
  </td>
</tr>
