<a href="{{url('/?tag='.$tag->id)}}">
  <div class="flex items-center gap-1 py-1 px-2.5 rounded text-xs"
       style="background:{{ $tag->bgcolor }}; color:{{$tag->color}}">
    @if($tag->icon_active)
      <div class="mr-1" style="color:{{$tag->color}}">
        @isset($tag->icon)
          <x-icon class="w-4" name="{{ $tag->icon }}"/>
        @endisset
      </div>
    @elseif($tag->image)
      <img src="{{asset($tag->image)}}"
           alt="{{ $tag->name.' image' }}"
           class="w-6 rounded-full"/>
    @endif
    <p>{{ $tag->name }}</p>
  </div>
</a>