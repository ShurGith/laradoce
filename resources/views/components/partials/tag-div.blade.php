<a href="{{url('/?tag='.$tag->id.'&tag_name='.$tag->name)}}">
  <div class="flex items-center justify-start gap-1 py-1 px-2 ml-4 mt-0.5 rounded"
       style="background:{{ $tag->bgcolor }}">
    @if($tag->icon_active)
      <div style="color:{{$tag->color}}">
        @isset($tag->icon)
          <x-icon class="w-5" name="{{ $tag->icon }}"/>
        @endisset
      </div>
    @elseif($tag->image)
      <img src="{{asset($tag->image)}}"
           alt="{{ $tag->name .' image' }}"
           class="w-6 rounded-full"/>
    @endif
    <p class="text-[10px] px-2 py-1 rounded"
       style="color:{{$tag->color }}"> {{ $tag->name }}</p>
  </div>
</a>