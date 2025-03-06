<div class="-mx-px gap-2 grid grid-cols-2 sm:mx-0 md:grid-cols-3 lg:grid-cols-4">
  @foreach($posts as $post)
    <div
      class="flex flex-col justify-between bg-gray-100 group relative border-b border-r rounded border-gray-200 p-4 sm:p-6">
      <div class="flex flex-col items-center gap-4">
        @if($post->image)
          <img src="{{ asset('storage/'.$imagen->image_path) }}" alt="TODO"
               class="aspect-square rounded-lg bg-gray-200 object-cover group-hover:opacity-75 max-h-38">
        @else
          <img src="{{ Avatar::create($post->title)->toBase64() }}"
               alt="TODO"
               class="group-hover:opacity-70">
        @endif
      </div>
      <div class="pb-4 pt-10 text-center">
        <h3 class="text-sm font-medium text-gray-900">
          <a href="#">
            <span aria-hidden="true" class="absolute inset-0"></span>
            {{ $post->title }}
          </a>
        </h3>
        <div class="mt-3 flex flex-col items-center">
          <p class="sr-only">5 out of 5 stars</p>
          <div class="flex items-center">
            <svg class="size-5 shrink-0 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                 data-slot="icon">
              <path fill-rule="evenodd"
                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                    clip-rule="evenodd"/>
            </svg>
            <svg class="size-5 shrink-0 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                 data-slot="icon">
              <path fill-rule="evenodd"
                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                    clip-rule="evenodd"/>
            </svg>
            <svg class="size-5 shrink-0 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                 data-slot="icon">
              <path fill-rule="evenodd"
                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                    clip-rule="evenodd"/>
            </svg>
            <svg class="size-5 shrink-0 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                 data-slot="icon">
              <path fill-rule="evenodd"
                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                    clip-rule="evenodd"/>
            </svg>
            <svg class="size-5 shrink-0 text-yellow-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"
                 data-slot="icon">
              <path fill-rule="evenodd"
                    d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401Z"
                    clip-rule="evenodd"/>
            </svg>
          </div>
          <p class="mt-1 text-sm text-gray-500">{{ rand(12, 45) }} reviews</p>
        </div>
      </div>
      {{--      @dd($post->tagposts())--}}
    </div>
  @endforeach
</div>