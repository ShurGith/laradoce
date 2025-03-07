<div class="-mx-px gap-2 grid grid-cols-2 sm:mx-0 md:grid-cols-3 lg:grid-cols-4">
    @foreach($products as $product)
        <div
            class="flex flex-col justify-start bg-gray-100 group relative border-b border-r rounded border-gray-200 p-2">
            <div class="flex flex-col items-center gap-4">
                <img src="{{ $product->getImgPal() }}" alt="{{$product->name."imagen-principal"}}"
                     class="aspect-square rounded-lg bg-gray-200 object-cover group-hover:opacity-75 max-w-28"/>
            </div>

            <div class="pb-4 pt-2 min-h-20 gap-2 flex flex-col items-center">
                <h3 class="text-xl font-medium text-gray-900">
                    <a href="{{ route('products.show', $product) }}">{{ $product->name }} </a>
                </h3>
                <!-- Corazón Favoritos -->
                @php
                    $enFavorites= strpos(request()->cookie('cookie_favorites'), $product->id);
                @endphp
                <button type="button" data-id="{{ $product->id }}"
                        class="favorite-btn cursor-pointer ml-4 flex items-center justify-center rounded-md px-3 py-3 text-gray-400 hover:bg-gray-100 hover:text-green-500">
                    <x-heroicon-m-heart class="h-6 w-6 {{ $enFavorites ? 'text-green-500':'' }}"></x-heroicon-m-heart>
                    <span class="sr-only">Add to favorites</span>
                </button>
                <!-- Fin Corazón Favoritos -->
                @if($product->oferta)
                    <h5
                        class="w-1/2 inline-flex justify-center items-center gap-x-1.5 rounded-md px-2 py-1 text-xs font-medium text-white bg-green-600 ring-1 ring-inset ring-green-700">
                        <svg class="size-2.5 fill-green-300" viewBox="0 0 6 6" aria-hidden="true">
                            <circle cx="3" cy="3" r="3"/>
                        </svg>
                        {{$product->descuento}}% Descuento
                    </h5>
                @endif
            </div>
            <div class="border items-center justify-center">
                <!-- ## ESTRELLAS ## -->
                @include('components.partials.stars')
                <!-- ## FIN ESTRELLAS ## -->
                <div class="w-full mt-4">
                    <!-- ### PRECIOS ### -->
                    @include('components.partials.precios')
                    <!-- ### FIN PRECIOS ### -->
                    <div class="flex flex-col items-center gap-2 justify-center mt-4">
                        @if($product->units)
                            <a href="{{ route('product.buyit', $product) }}">
                                <span
                                    class="max-w-fit inline-flex items-center gap-x-1.5 rounded-full bg-green-100 px-2 py-1 text-xs font-medium text-green-700">
                            <svg class="size-1.5 fill-green-500" viewBox="0 0 6 6" aria-hidden="true">
                              <circle cx="3" cy="3" r="3"/>
                            </svg>
                          {{  __('Buy Now') }}
                          </span></a>
                            <h4 class="text-xs mt-2 w-full text-center">Quedan: {{ $product->units }} unidades</h4>
                        @else
                            <span
                                class="max-w-fit inline-flex items-center gap-x-1.5 rounded-full bg-red-100 px-2 py-1 text-xs font-medium text-red-700">
                              <svg class="size-1.5 fill-red-500" viewBox="0 0 6 6" aria-hidden="true">
                                <circle cx="3" cy="3" r="3"/>
                              </svg>
                              {{ __('Out of Stock') }}
                            </span>
                        @endif
                    </div>
                    <!-- ## CATERGORÍAS Y TAGS ## -->
                    <div class="mt-4">
                        @include('components.partials.categorias-tags')
                    </div>
                    <!-- ## FIN CATERGORÍAS Y TAGS ## -->
                </div>
            </div>
        </div>
    @endforeach
</div>
</div>
<div class="mt-2">
    {{ $products->links() }}
</div>
<script src="{{asset('js/favorites.js')}}"></script>
