<a href="{{url('/?category='.$category->id)}}">
  <div class="flex w-full max-w-20xl min-h-8 items-center gap-1 py-1 px-2 rounded text-base"
       style="background:{{ $category->bgcolor }}; color:{{$category->color}}">
    @if($category->icon_active)
      <div class="mr-1" style="color:{{$category->color}}">
        @isset($category->icon)
          <x-icon class="w-5" name="{{ $category->icon }}"/>
        @endisset
      </div>
    @elseif($category->image)
      <img src="{{asset($category->image)}}"
           alt="{{ $category->name.' image' }}"
           class="w-6 rounded-full"/>
    @endif
    <p class="">{{ $category->name }}</p>
  </div>
</a>