<div class="-mx-px gap-2 grid grid-cols-2 sm:mx-0 md:grid-cols-3 lg:grid-cols-4">
  @foreach($products as $product)
    <div
      class="relative bg-gray-100 group relative border-b border-r rounded-lg border-gray-200 shadow-md shadow-gray-800">
      <div class="w-full grid grid-rows-subgrid justify-items-center">
        <!-- ## Oferta ## -->
        <div class="h-6 w-full">
          @if($product->getHayOferta())
            <div
              class="flex justify-center rounded-tl-lg rounded-tr-lg items-center gap-x-1.5 px-2 py-1 text-xs font-medium text-white bg-green-600 ">
              <svg class="size-2.5 fill-green-300" viewBox="0 0 6 6" aria-hidden="true">
                <circle cx="3" cy="3" r="3"/>
              </svg>
              {{$product->descuento}}% Descuento
            </div>
          @endif
        </div>
        <!-- The Image -->
        <div class="w-full min-w-full h-62 bg-cover  bg-no-repeat "
             style="background-image:url( {{ $product->getImgPal() }});">
        </div>
        <div class="flex flex-col items-center w-full justify-center gap-y-6 mb-4">
          <!-- Name -->
          <h3 class="z-12 text-xl font-bold text-gray-500 mt-2">
            <a href="{{ route('products.show', $product) }}">{{ $product->name }} </a>
          </h3>
          <!-- ### PRECIOS ### -->
          @include('components.partials.precios')
          <!-- ### UNIDADES ### -->
          @include('components.partials.unidades')
          <!-- Corazón Favoritos -->
          @php
            $enFavorites= strpos(request()->cookie('cookie_favorites'), $product->id);
          @endphp
          @include('components.partials.heart')
          <!-- ## ESTRELLAS ## -->
          @include('components.partials.stars')
        </div>
        <!-- ## CATERGORÍAS Y TAGS ## -->
        <div class="gap-0.5 min-h-28 w-full justify-items-center">
          @include('components.partials.categorias-tags')
        </div>
      </div>
    </div>
  @endforeach
</div>
<div class=" mt-2
          ">
  {{ $products->links() }}
</div>
<script src="{{asset('js/favorites.js')}}"></script>
