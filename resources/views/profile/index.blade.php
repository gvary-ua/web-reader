@props([
  'user',
  'my_covers' => [],
  'liked_covers' => [],
])

@section('scripts')
  @vite(['resources/js/slider.js'])
@endsection

@php
  $sameUser = Auth::user() == $user;
  if ($sameUser) {
    $userBooksTitle = __('My books');
    $userLikesTitle = __('I like');
  } else {
    $userBooksTitle = $user->displayName() . ' ' . __('books');
    $userLikesTitle = $user->displayName() . ' ' . __('likes');
  }
@endphp

<x-app-layout>
  <section class="min-h-36 bg-secondary-1 md:min-h-52"></section>
  <section class="max-w-[50rem] px-4 sm:flex md:mx-auto">
    <div class="relative mx-auto -mt-28 h-44 w-44 sm:mx-0 sm:-mt-16">
      <!-- Image -->
      <img
        src="{{ asset($user->profile_img_key ? 'storage/public/' . $user->profile_img_key : '/icons/user.svg') }}"
        alt="{{ $user->login }}"
        class="h-full w-full rounded-full border-4 border-background"
      />

      <!-- Upload Icon -->
      @if ($sameUser)
        <div
          class="absolute inset-0 flex cursor-pointer items-center justify-center rounded-full bg-[white] bg-opacity-0 opacity-0 transition-all hover:bg-opacity-80 hover:opacity-100"
          onclick="document.getElementById('avatar-upload').click()"
        >
          <img class="h-10 w-10" src="/icons/upload.svg" alt="upload icon" />
        </div>
        <form
          id="avatar-upload-form"
          action="{{ route('profile.avatar.upload') }}"
          method="POST"
          enctype="multipart/form-data"
        >
          @csrf
          <input
            id="avatar-upload"
            name="avatar"
            type="file"
            accept="image/*"
            class="hidden"
            onchange="document.getElementById('avatar-upload-form').submit()"
          />
        </form>
      @endif
    </div>
    <div class="mt-2 flex flex-grow justify-between sm:ml-4 sm:mt-4 md:ml-8">
      <span>
        <x-p size="2xl">{{ $user->displayName() }}</x-p>
        @if ($user->first_name || $user->last_name || $user->pen_name)
          <x-p size="base" class="on-background-2">&commat;{{ $user->login }}</x-p>
        @endif
      </span>
      @can('update', $user)
        <span>
          <!-- Desktop button -->
          <x-button
            class="hidden sm:flex"
            size="xs"
            icon="/icons/edit-white.svg"
            iconPosition="right"
            href="{{ route('settings.profile', ['user' => $user]) }}"
          >
            <x-p size="base">{{ __('Edit') }}</x-p>
          </x-button>
          <!-- Mobile button -->
          <x-button
            class="sm:hidden"
            size="xs"
            icon="/icons/edit-white.svg"
            href="{{ route('settings.profile', ['user' => $user]) }}"
          ></x-button>
        </span>
      @endcan
    </div>
  </section>
  @if ($my_covers)
    <x-section.slider-covers
      label="{{$userBooksTitle}}"
      sliderId="swiper1"
      :covers="$my_covers"
      href="{{route('profile.books.index', ['user' => $user])}}"
    />
  @endif

  @if ($liked_covers)
    <x-section.slider-covers label="{{$userLikesTitle}}" sliderId="swiper2" :covers="$liked_covers" />
  @endif

  @if (! $my_covers && ! $liked_covers)
    <section class="my-20 max-w-[50rem] px-4 sm:flex md:mx-auto">
      <x-p class="w-full text-center">This author doesn't have any published titles yet</x-p>
    </section>
  @endif
</x-app-layout>
