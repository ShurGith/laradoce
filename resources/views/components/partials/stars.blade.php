<div class="group/item mt-3 mx-auto relative flex  justify-center w-full">
  <h3 class="sr-only">Reviews</h3>
  <span
    class="opacity-0 transition-all duration-300 group-hover/item:opacity-100 absolute px-2 py-1 rounded text-xs text-white bg-black bottom-4 -right-8 ">{{ __('Rating:') }} {{ $product->stars / 10 }}</span>
  {!!  $product->getStars() !!}
</div>
