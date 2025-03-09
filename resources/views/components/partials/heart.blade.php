<div type="button" data-id="{{ $product->id }}" data-tipo="heart-button"
     class="cursor-pointer border text-xs flex items-center bg-gray-50 pr-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500">
    <button>
        <x-heroicon-m-heart
            class="{{request()->routeIs('products.show')?'h-10 w-10': 'h-6 w-6' }} {{ $enFavorites ? 'text-green-500':'' }}"></x-heroicon-m-heart>
        <span class="sr-only">{{__('Add to favorites')}}</span>
    </button>
    <p class="{{$enFavorites ? 'text-green-600 ': 'hidden'}}">{{__('In favorites')}}</p>
    <p class="{{!$enFavorites ? 'visible': 'hidden'}}">{{__('Add to favorites') }}</p>
</div>
