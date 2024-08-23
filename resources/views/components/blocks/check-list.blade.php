@props([
  'data',
])

{{-- Class styles are from web-editor --}}
<div class="flex flex-col gap-[6px] py-[0.4em]">
  @foreach ($data->items as $item)
    <div class="box-content flex items-start">
      <div class="mr-2 mt-[calc(.785em-11px)] flex h-[22px] w-[22px] items-center">
        <span
          class="{{ 'relative ml-0 box-border inline-block h-[20px] w-[20px] flex-shrink-0 rounded-[5px] border-[1px] border-solid' . ($item->checked === true ? ' border-[#369FFF] bg-[#369FFF]' : ' border-[#C9C9C9]') }}"
        >
          <svg
            class="{{ ' h-[20px] w-[20px] absolute left-[-1px] top-[-1px] max-h-[20px]' . ($item->checked === true ? ' opacity-100' : ' opacity-0') }}"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            fill="none"
            viewBox="0 0 24 24"
          >
            <path
              class="stroke-[#fff]"
              stroke="currentColor"
              stroke-linecap="round"
              stroke-width="2"
              d="M7 12L10.4884 15.8372C10.5677 15.9245 10.705 15.9245 10.7844 15.8372L17 9"
            ></path>
          </svg>
        </span>
      </div>
      <p>{!! $item->text !!}</p>
    </div>
  @endforeach
</div>
