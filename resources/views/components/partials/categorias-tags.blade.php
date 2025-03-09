<div class="mb-2 w-3/4">
  @foreach($product->categories as $category)
    @include('components.partials.category-div')
    <!-- Tags -->
    @foreach($product->tags as $tag)
      @if($tag->category_id === $category->id)
        @include('components.partials.tag-div')
      @endif
    @endforeach
    <!-- Tags -->
  @endforeach
</div>