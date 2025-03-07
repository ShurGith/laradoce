@foreach($product->categories as $category)
    <div class="mb-2 w-3/4">
        <a href="{{url('/?category='.$category->id).'&categ_name='.$category->name}}">
            <div class="flex w-full max-w-20xl min-h-8 items-center gap-1 py-1 px-1 rounded text-base"
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
        @foreach($product->tags as $tag)
            @if($tag->category_id === $category->id)
                <a href="{{url('/?tag='.$tag->id.'&tag_name='.$tag->name)}}">
                    <div class="flex items-center justify-start gap-1 py-1 px-1 ml-4 mt-[3px] rounded"
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
                           style="color:{{$tag->color}}"> {{ $tag->name }}</p>
                    </div>
                </a>
            @endif
        @endforeach
    </div>
@endforeach
