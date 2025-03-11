@props([
    'enFavorites' => strpos(request()->cookie('cookie_favorites'), $product->id),
  ])
<style>
    [data-tipo="heart-button"]:hover [data-role='tooltip'] {
        opacity: 1;
        transform: translate(25%, -120%);
        z-index: 100;
    }
</style>
<div data-id="{{ $product->id }}" data-tipo="heart-button"
     class="{{$enFavorites ? 'text-green-500': ''}} cursor-pointer border text-xs flex items-center bg-gray-50 pr-2 text-gray-400 hover:bg-gray-300">
  <button>
    <x-heroicon-m-heart
      class="{{request()->routeIs('products.show')?'h-10 w-10': 'h-6 w-6' }} "></x-heroicon-m-heart>
    <span class="sr-only">{{ $enFavorites ? __('Add to favorites') :  __('In favorites') }}</span>
  </button>
  <p id="in-favorites" data-tipo="tip-text"
     class="{{ $enFavorites ? '': 'hidden'}} font-semibold">{{ __('In favorites') }}</p>
  <p id="add-favorite" data-tipo="tip-text"
     class="{{ $enFavorites ? 'hidden': ''}} font-semibold">{{ __('Add to favorites') }}</p>
  <div class="min-w-max max-h-8 transition-all duration-200 absolute bg-black opacity-0 px-2 py-1 rounded"
       data-role="tooltip">
    <span data-tipo="tip-text"
          class="{{ $enFavorites ? '': 'hidden '}}relative z-1 text-white font-bold text-xs">{{ __('Click remove favorites') }}</span>
    <span data-tipo="tip-text"
          class="{{ $enFavorites ? 'hidden ': '' }}relative z-1 text-white font-bold text-xs">{{ __('Click add to favorites') }}</span>
    <div class="w-4 h-10 bg-black rotate-70 -translate-y-3.5 translate-x-8"></div>
  </div>
</div>
