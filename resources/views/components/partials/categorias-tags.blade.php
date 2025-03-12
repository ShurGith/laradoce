@foreach($product->categories as $category)
  @include('components.partials.category-div')
  <!-- Tags -->
  @foreach($product->tags as $index => $tag)
    @if($tag->category_id === $category->id)
      <div class="mt-0.5" style="margin-left: {{ 20 + (20 * $index+1) }}px">
        @include('components.partials.tag-div')
      </div>
    @endif
  @endforeach
  <!-- Tags -->
@endforeach
