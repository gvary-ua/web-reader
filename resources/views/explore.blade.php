@section('scripts')
  @vite(['resources/js/search.js'])
  @vite(['resources/css/search.css'])
  <script>
    window.onload = function () {
      window.startSearch('{{ session('locale') }}');
    };
  </script>
@endsection

<x-app-layout>
  <section class="ais-InstantSearch">
    <div class="bg-secondary-1 px-4 pb-6 pt-8 md:pt-16">
      <div class="mx-auto md:max-w-[60rem]">
        <div id="searchbox"></div>
      </div>
    </div>
    <div class="mt-8 px-4" x-data="{ showFilters: false }">
      <div class="mx-auto md:max-w-[60rem]">
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <div class="flex cursor-pointer items-center" @click="showFilters = !showFilters">
              <img src="icons/filter.svg" alt="icon" />
              <x-p class="ml-2 font-medium">{{ __('Filter') }}</x-p>
            </div>
            <div class="ml-8 hidden text-on-background-2 sm:block" id="stats"></div>
          </div>
          <div class="flex items-center">
            <x-p class="mr-2 font-medium">{{ __('Sort by') }}</x-p>
            <div id="sort-by"></div>
          </div>
        </div>
        <div
          class="mt-4 grid gap-x-4 gap-y-4 [grid-template-columns:repeat(auto-fill,minmax(200px,1fr))]"
          x-show="showFilters"
          x-cloak
        >
          <div>
            <x-h level="h5">Genres</x-h>
            <div id="genres-refinement-list"></div>
          </div>
          <div>
            <x-h level="h5">Authors</x-h>
            <div id="authors-refinement-list"></div>
          </div>
          <div>
            <x-h level="h5">Language</x-h>
            <div id="language-refinement-list"></div>
          </div>
          <div>
            <x-h level="h5">Type</x-h>
            <div id="cover-type-refinement-list"></div>
          </div>
        </div>
        <div class="mt-6" id="pagination"></div>
      </div>
    </div>
    <div class="mb-8 px-4 sm:px-20">
      <div id="hits"></div>
    </div>
  </section>
</x-app-layout>
