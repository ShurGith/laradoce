<div class="-mx-px gap-2 grid grid-cols-2 sm:mx-0 md:grid-cols-3 lg:grid-cols-4">
  @foreach($products as $product)
    <div
      class="flex flex-col justify-start bg-gray-100 group relative border-b border-r rounded-lg border-gray-200 shadow-md shadow-gray-800">
      <!-- ## Oferta ## -->
      @if($product->oferta)
        <h5
          class="w-full mb-4 flex justify-center rounded-tl-lg rounded-tr-lg items-center gap-x-1.5 px-2 py-1 text-xs font-medium text-white bg-green-600 ">
          <svg class="size-2.5 fill-green-300" viewBox="0 0 6 6" aria-hidden="true">
            <circle cx="3" cy="3" r="3"/>
          </svg>
          {{$product->descuento}}% Descuento
        </h5>
      @else
        <div class="h-10"></div>
      @endif
      <div class="flex flex-col items-center gap-4">
        <img src="{{ $product->getImgPal() }}" alt="{{$product->name."imagen-principal"}}"
             class="aspect-square rounded-lg bg-gray-200 object-cover group-hover:opacity-75 max-w-28"/>
      </div>
      
      <div class="pb-4 pt-2 min-h-20 gap-2 flex flex-col items-center">
        <h3 class="z-12 text-xl font-medium text-gray-900">
          <a href="{{ route('products.show', $product) }}">{{ $product->name }} </a>
        </h3>
        <!-- Corazón Favoritos -->
        @php
          $enFavorites= strpos(request()->cookie('cookie_favorites'), $product->id);
        @endphp
        @include('components.partials.heart')
        <!-- ## Fin Corazón Favoritos ## -->
        
        <!-- ## ESTRELLAS ## -->
        @if($product->stars > 10)
          @include('components.partials.stars')
        @else
          <div class="h-16"></div>
        @endif
        <!-- ### PRECIOS ### -->
        @include('components.partials.precios')
        <!-- ### UNIDADES ### -->
        <div>
          @include('components.partials.unidades')
        </div>
        <!-- ## CATERGORÍAS Y TAGS ## -->
        <div>
          @include('components.partials.categorias-tags')
        </div>
      </div>
    </div>
  @endforeach
</div>
</div>
<div class=" mt-2
          ">
  {{ $products->links() }}
</div>
<script src="{{asset('js/favorites.js')}}"></script>
