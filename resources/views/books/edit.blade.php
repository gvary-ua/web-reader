@props([
  'cover_id',
  'cover_type_id',
  'title',
  'description',
  'genres',
  'languages',
  'chapters',
  'type',
  'imgSrc',
])

@section('scripts')
  @vite(['resources/js/cropper.js'])
@endsection

<x-app-layout>
  {{-- Image cropper --}}
  <section
    id="cropper-section"
    class="fixed left-0 top-0 z-40 h-full w-full bg-primary-1/30"
    x-data="{ cropperVisible: false }"
    x-show="cropperVisible"
    x-on:show-cropper="cropperVisible = true"
    x-on:close-cropper="cropperVisible = false"
    x-cloak
  >
    <div
      class="absolute left-0 top-0 z-50 h-full w-full bg-background px-4 pb-4 pt-8 sm:relative sm:top-1/2 sm:mx-auto sm:h-fit sm:w-fit sm:-translate-y-1/2 sm:rounded-10"
    >
      <div class="mb-4 flex w-full items-center justify-between">
        <x-p size="2xl" weight="med" class="text-center sm:text-left">{{ __('Profile photo') }}</x-p>
        {{-- Some minus margin to align with right border --}}
        <img
          class="mr-[-6px]"
          src="/icons/close.svg"
          alt="Close icon"
          class="cursor-pointer"
          x-on:click="cropperVisible = !cropperVisible"
        />
      </div>
      {{-- Content of a popup --}}
      <div class="mx-auto h-[432px] w-72">
        <img src="/icons/user.svg" id="cropper-image" alt="Image to Crop" class="max-w-full" />
      </div>
      <x-button class="mx-auto mt-4 cursor-pointer" onclick="cropAndSet('cover-image', 'cover-image-upload')">
        {{ __('Save') }}
      </x-button>
    </div>
  </section>
  <section class="px-4 pt-8 md:px-20 md:pt-14">
    <div class="mx-auto md:max-w-[60rem]">
      <form method="POST" action="{{ route('books.update', ['book' => $cover_id]) }}" enctype="multipart/form-data">
        @csrf
        <input
          id="cover-image-upload"
          name="cover_image"
          type="file"
          accept="image/*"
          class="hidden"
          onclick="this.value = null"
          onchange="openCropper(event, 'cover')"
        />
        <div class="md:flex">
          <div class="relative mx-auto max-h-[288px] w-full max-w-[192px] md:max-h-[432px] md:max-w-[288px]">
            <img
              width="100%"
              height="100%"
              class="max-h-[288px] min-h-[288px] min-w-[192px] max-w-[192px] rounded-lg object-cover md:max-h-[432px] md:min-h-[432px] md:min-w-[288px] md:max-w-[288px]"
              src="{{ asset($imgSrc ? 'storage/public/' . $imgSrc : 'blank-224X320.webp') }}"
              id="cover-image"
            />
            <x-badge size="sm" class="absolute bottom-2 left-2 bg-surface-1" type="square">
              {{ __($type) }}
            </x-badge>
            <div
              class="absolute inset-0 flex cursor-pointer items-center justify-center bg-[white] bg-opacity-0 opacity-0 transition-all hover:bg-opacity-80 hover:opacity-100"
              onclick="document.getElementById('cover-image-upload').click()"
            >
              <img class="h-10 w-10" src="/icons/upload.svg" alt="upload icon" />
            </div>
          </div>
          <div class="mt-2 w-full md:ml-4 md:mt-0">
            <x-input id="title" name="title" label="{{__('Title')}}:" value="{{$title}}" />
            <x-checkbox-holder
              name="genres[]"
              label="{{__('Genre')}}:"
              :items="$genres"
              class="mt-4"
              innerClass="h-40"
            ></x-checkbox-holder>
            <x-select name="lang" label="{{__('Language')}}:" :items="$languages" class="mt-6"></x-select>
          </div>
        </div>
        <x-textarea name="description" limit="700" label="{{__('Description')}}:" class="mt-6 min-h-72 md:min-h-44">
          {{ $description }}
        </x-textarea>
        <x-p size="sm" class="mt-2">
          {{ __('Our search engine relies on your book\'s description, so be sure to make it detailed and engaging!') }}
        </x-p>
        <x-checkbox-holder
          name="public_chapters[]"
          label="{{ ($cover_type_id == 1) ? __('Published chapters') : __('Publish verse')}}:"
          :items="$chapters"
          class="mt-6"
          innerClass="max-h-40"
        ></x-checkbox-holder>
        @if ($cover_type_id == 1)
          <x-p size="sm" class="mt-2">
            {{ __('Your book becomes visible to others once you\'ve published at least one chapter.') }}
          </x-p>
          <x-p size="sm">{{ __('If no chapters are published, it will remain hidden.') }}</x-p>
        @endif

        <div class="mb-14 mt-14 md:flex md:justify-between">
          <x-button class="w-full md:w-fit" href="{{route('books.index')}}" variant="secondary-2" size="base">
            {{ __('Back') }}
          </x-button>
          <x-button class="mt-4 w-full md:mt-0 md:w-fit" type="submit" variant="primary" size="base">
            {{ __('Save') }}
          </x-button>
        </div>
      </form>
    </div>
  </section>
</x-app-layout>
