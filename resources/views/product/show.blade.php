<style>
    [data-role="tab-info"] {
        display: grid;
        grid-template-rows: min-content 0fr;
        transition: grid-template-rows 500ms;
    }

    [data-role="tab-info"].mostrado {
        grid-template-rows: min-content 1fr;
    }

    #marco {
        --s: 80px; /* corner size */
        padding: 15px; /* the gap */
        border: 8px solid #69D2E7;
        border-radius: 15px;
        mask: conic-gradient(at var(--s) var(--s), #0000 75%, #000 0) 0 0/calc(100% - var(--s)) calc(100% - var(--s)),
        conic-gradient(#000 0 0) content-box;
    }
</style>
<x-layouts.app :meta-title="$product->name" :header-text="$product->name">
  <!-- ## Sección Principal ## -->
  <section class="mx-auto max-w-2xl lg:max-w-none">
    <!-- Product -->
    <div class="lg:grid lg:grid-cols-[65%_35%] lg:items-start">
      <!-- Image gallery -->
      <div class="flex flex-col pr-2">
        <div id="marco">
          <div id="img-div"
               class="cursor-pointer rounded-xl w-full min-w-full h-96 bg-cover  bg-no-repeat h-[580px] aspect-auto object-cover"
               style="background-image:url( {{ $product->getImgPal() }});">
          </div>
        </div>
        <!-- Fin Imagen Principal -->
        <!-- Image Thumbs -->
        <div class="mt-6 hidden w-full max-w-2xl sm:block lg:max-w-none">
          <div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" data-role="tablist">
            @foreach($product->getThumbs() as $thumb)
              <button class="relative flex h-24 cursor-pointer items-center justify-center rounded-md bg-white text-sm
              font-medium uppercase text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring
              focus:ring-indigo-500/50 focus:ring-offset-4" role="tab" type="button">
                <span class="sr-only">Angled view</span>
                <span
                  class="pointer-events-none absolute inset-0 rounded-md ring-2 ring-indigo-500 ring-transparent ring-offset-2"
                  aria-hidden="true"></span>
                <span class="absolute inset-0 overflow-hidden rounded-md"> <img
                    src="{{ asset( $thumb) }}" data-role="img-slider"
                    alt="{{$thumb}}" class="size-full object-cover"> </span>
              </button>
            @endforeach
          </div>
        </div>
        <!-- Fin Image Thumbs -->
      </div>
      <!-- Product info -->
      <div class="pt-12 flex flex-col justify-center items-center gap-y-4 px-4 sm:mt-16 sm:px-0 lg:mt-0">
        <h1 class="text-5xl mb-4 font-bold tracking-tight text-gray-900">{{ $product->name }}</h1>
        <!-- Precio -->
        @include('components.partials.precios' ,[ "textFinal" => "text-3xl"])
        <!-- Fin Precio -->
        <!-- Estrellas -->
        @include('components.partials.stars')
        <!--Fin Estrellas-->
        <!-- Description y Descuento -->
        <div class="mt-6">
          <h3 class="sr-only">Description</h3>
          <div class="space-y-6 text-base text-gray-700">
            {!! tiptap_converter()->asHTML($product->description) !!}
          </div>
          @if($product->oferta)
            <div
              class="max-w-fit mt-3 inline-flex justify-center items-center gap-x-1.5 rounded-md px-2 py-1 text-sm font-medium text-white bg-green-600 border border-green-700">
              <div class="size-2.5 bg-green-300 border-white border rounded-full"></div>
              {{$product->descuento}}% {{ __('Discount') }}
            </div>
          @endif
        </div>
        <!-- Fin Description  y descuento-->
        @if($product->units)
          <!-- Colors -->
          <form class="mt-6">
            <h3 class="text-sm text-gray-600">Color</h3>
            <fieldset aria-label="Choose a color" class="mt-2">
              <div class="flex items-center gap-x-3">
                <label aria-label="Washed Black"
                       class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-700 focus:outline-none">
                  <input type="radio" name="color-choice" value="Washed Black" class="sr-only">
                  <span aria-hidden="true"
                        class="size-8 rounded-full border border-black/10 bg-gray-700"></span>
                </label>
                <label aria-label="White"
                       class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-400 focus:outline-none">
                  <input type="radio" name="color-choice" value="White" class="sr-only">
                  <span aria-hidden="true"
                        class="size-8 rounded-full border border-black/10 bg-white"></span>
                </label>
                <label aria-label="Washed Gray"
                       class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-500 focus:outline-none">
                  <input type="radio" name="color-choice" value="Washed Gray" class="sr-only">
                  <span aria-hidden="true"
                        class="size-8 rounded-full border border-black/10 bg-gray-500"></span>
                </label>
              </div>
            </fieldset>
          </form>
          <!-- Botón Compra y Botón Favorito -->
          <div class="flex items-center gap-x-4">
            <!-- Botón Add to Bag -->
            <a href="{{ route('product.buyit', $product) }}"
               class="py-2 px-4 bg-gray-500 hover:bg-gray-600 transition-all rounded-md text-white duration-200">
              {{__('Add to bag')}}
            </a>
            <!--Fin Botón Add to Bag -->
            <!-- Corazón Favoritos -->
            @include('components.partials.heart')
          </div>
        @endif
        @include('components.partials.unidades')
      </div>
      <!--  FinProduct info -->
    </div>
  </section>
  <!-- ## Fin Sección Principal ## -->
  <!-- ## Sección Detalles, Categorías y Etiquetas ## ## -->
  <section aria-labelledby="details-heading" class="mt-12 grid sm:grid-cols-[repeat(auto-fit,minmax(0,1fr))] gap-12">
    <!-- Detalles Adicionales -->
    <div>
      <h2 id="details-heading" class="pb-2">{{ __('Additional details') }}</h2>
      @foreach($product->featuretitles as $feature)
        <div data-role="tab-info"
             class="border-t-gray-200 border-t pb-4 overflow-hidden transition ease-linear duration-1500">
          <button type="button"
                  class="cursor-pointer group relative flex w-full items-center justify-between py-2 my-4 "
                  data-role="button" aria-expanded="false">
            <h3 class="text-sm font-medium pl-4 text-gray-900"> {{ $feature->title }}</h3>
            <span class="ml-6 flex items-center mr-4">
                      <svg class="block size-6 text-gray-400 group-hover:text-gray-500" fill="none"
                           viewBox="0 0 24 24"
                           stroke-width="1.5" stroke="currentColor" aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
                      </svg>
                      <svg class="hidden size-6 text-indigo-600 group-hover:text-indigo-500" fill="none"
                           viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true"
                           data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14"/>
                      </svg>
                    </span>
          </button>
          <div class="overflow-hidden" id="disclosure">
            {!! tiptap_converter()->asHTML($feature->text) !!}
          </div>
        </div>
      @endforeach
    </div>
    <!-- Fin Detalles Adicionales -->
    <!-- Categorías y Etiquetas -->
    <div>
      <h2 id="details-heading" class="">{{ __('Categories') }}</h2>
      <div class="max-w-1/3 ml-10 mt-4">
        @include('components.partials.categorias-tags')
      </div>
    </div>
    <!-- Fin Categorías y Etiquetas -->
  </section>
  <!-- ## Fin Sección Detalles, Categorías y Etiquetas ## ## -->
  <!-- Repeater con Adicionales-->
  <section aria-labelledby="related-heading" class="mt-10 border-t border-gray-200 px-4 py-16 sm:px-0">
    <h2 id="related-heading" class="text-xl font-bold text-gray-900">Customers also bought</h2>
    <div class="mt-8 grid grid-cols-2 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
      @foreach($randoms as $random)
        <div class="relative h-72 w-full overflow-hidden rounded-lg">
          <img
            src="{{ $random->getImgPal() }}"
            alt="Front of zip tote bag with white canvas, black canvas straps and handle, and black zipper pulls."
            class="size-full object-cover">
          
          <div class="absolute top-2 ">
            <h3 class="text-sm font-medium text-gray-900">{{ $random->name }}</h3>
            @if($random->descuento)
              <span
                class="inline-flex items-center gap-x-1.5 rounded-md bg-green-600 px-2 py-1 text-xs font-medium text-white">
                <svg class="size-1.5 fill-green-50" viewBox="0 0 6 6" aria-hidden="true">
                  <circle cx="3" cy="3" r="3"/></svg>
                {{ $random->descuento .'% '. __('Discount') }}</span>
            @endif
          </div>
          <div
            class="absolute inset-x-0 top-0 flex h-72 items-end justify-end overflow-hidden rounded-lg p-4">
            <div aria-hidden="true"
                 class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50"></div>
            <p class="relative text-lg font-semibold text-white">{{$random->precios($random->oferta)}}
              <span class="align-super text-base">{{$random->precios($random->oferta, true)}}</span> €</p>
          </div>
          <a href="{{ route('products.show', $random) }}"
             class="absolute left-2 bottom-4 flex items-center justify-center rounded-md border border-transparent bg-gray-100 px-8 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200">Ver</a>
        </div>
      @endforeach
    </div>
  </section>
  <!-- Fin Repeater con Adicionales -->
</x-layouts.app>

<!-- Modal Imagen -->
<div class="relative -z-10 transition-all ease-out duration-300 opacity-0" data-role="modal-image" role="dialog"
     aria-modal="true">
  <div class="fixed inset-0 bg-gray-500/95 transition-opacity" aria-hidden="true"></div>
  <div class="fixed w-full inset-0 z-10 w-screen">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0" data-role="fondo">
      <div
        class="relative w-full min-w-1/2 overflow-hidden rounded-lg bg-white px-4 pb-4 pt-5 text-left shadow-xl sm:my-8 sm:w-full sm:max-w-lg sm:p-6"
        role="no-cerrar">
        <x-heroicon-c-x-mark class="z-10 h-10 w-10 cursor-pointer" id="closeModal"/>
        <img class="size-full object-contain" src="" role="no-cerrar">
      </div>
    </div>
  </div>
</div>
<!-- JavaScript -->
<script src="{{asset('js/favorites.js')}}"></script>
<script src="{{asset('js/show-product.js')}}"></script>
