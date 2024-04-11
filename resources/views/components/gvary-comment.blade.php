<div {{
  $attributes->merge([
    'class' => 'relative text-center',
  ])
}}>
  <div class="relative inline-block sm:left-1/4">
    <img src="/icons/comment-landing.svg" alt="Comment" />
    <x-p size="xs" class="absolute left-0 top-0 w-full translate-y-full">
      Гортай нижче,
      <br />
      підібрали для тебе найкраще!
    </x-p>
    <!-- Magic number. Questions? -->
    <img class="relative left-[87%]" src="/icons/logo.svg" alt="Logo svg" />
  </div>
</div>
