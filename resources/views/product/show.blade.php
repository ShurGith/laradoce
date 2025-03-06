@props([
    'enFavorites' => strpos(request()->cookie('cookie_favorites'), $product->id),
    'rand' => rand(3,5),
    'css' => true,
  ])
<x-layouts.app :meta-title="$product->name" :header-text="$product->name">
  <link rel="stylesheet" href="../css/show.css">
  <section class="mx-auto max-w-2xl lg:max-w-none">
    <!-- Product -->
    <div class="lg:grid lg:grid-cols-2 lg:items-start lg:gap-x-8">
      <!-- Image gallery -->
      <div class="flex flex-col-reverse">
        <!-- Image selector -->
        <div class="mx-auto mt-6 hidden w-full max-w-2xl sm:block lg:max-w-none">
          <div class="grid grid-cols-4 gap-6" aria-orientation="horizontal" role="tablist">
            @foreach($product->imageproducts as $imagen)
              @if($imagen->img_pos !== 1)
                <button id="tabs-2-tab-1"
                        class="relative flex h-24 cursor-pointer items-center justify-center rounded-md bg-white text-sm font-medium uppercase text-gray-900 hover:bg-gray-50 focus:outline-none focus:ring focus:ring-indigo-500/50 focus:ring-offset-4"
                        aria-controls="tabs-2-panel-1" role="tab" type="button">
                  <span class="sr-only">Angled view</span>
                  <span
                    class="pointer-events-none absolute inset-0 rounded-md ring-2 ring-indigo-500 ring-transparent ring-offset-2"
                    aria-hidden="true"></span>
                  <span class="absolute inset-0 overflow-hidden rounded-md">
                        <img src="{{ asset( $imagen->img_path) }}" img-role="img-slider"
                             alt="{{$imagen->img_path}}" class="size-full object-cover">
                </span>
                </button>
              @endif
            @endforeach
          </div>
        </div>
        <div>
          <!-- Tab panel, show/hide based on tab state. -->
          <div id="img-div" aria-labelledby="tabs-2-tab-1" role="tabpanel" tabindex="0">
            <img src="{{ $product->getImgPal() }}" id="img-ppal" img-role="img-slider"
                 alt="{{$product->name . ' - imagen producto'}}"
                 class="aspect-square w-full object-cover sm:rounded-lg">
          </div>
          <!-- More images... -->
        </div>
      </div>
      <!-- Product info -->
      <div class="mt-10 px-4 sm:mt-16 sm:px-0 lg:mt-0">
        <h1 class="text-3xl font-bold tracking-tight text-gray-900">{{ $product->name }}</h1>
        <!-- Precio -->
        <div class="mt-3">
          <div class="flex items-center gap-8">
            <h4 class="text-3xl font-medium text-gray-900">{{ $product->precios(false) }}<span
                class="text-xl pl-1 align-super  ">{{ $product->precios(false, true) }}</span>
              €</h4>
            @if($product->oferta)
              <h4 class="line-through text-xl font-medium text-gray-900">{{  $product->precios( true ) }}
                <span
                  class="text-xs pl-1 align-super  ">{{  $product->precios( true, true ) }}</span> €
              </h4>
            @endif
          </div>
          <!-- Fin Precio -->
          <!-- Estrellas -->
          <div class="mt-3">
            <h3 class="sr-only">Reviews</h3>
            <div class="flex items-center">
              <div class="flex items-center">
                @for($i=0; $i<$rand; $i++)
                  <x-heroicon-m-star class="size-5 shrink-0 text-yellow-400"></x-heroicon-m-star>
                @endfor
                @for($i=0; $i<(5-$rand); $i++)
                  <x-heroicon-o-star class="size-5 shrink-0 text-gray-300"></x-heroicon-o-star>
                @endfor
              </div>
            </div>
          </div>
          <!--Fin Estrellas-->
          <!-- Description y Descuento -->
          <div class="mt-6">
            <h3 class="sr-only">Description</h3>
            <div class="space-y-6 text-base text-gray-700">
              {!! tiptap_converter()->asHTML($product->description) !!}
            </div>
            @if($product->oferta)
              <h5
                class="max-w-fit mt-3 inline-flex justify-center items-center gap-x-1.5 rounded-md px-2 py-1 text-xl font-medium text-white bg-green-600 ring-1 ring-inset ring-green-700">
                <svg class="size-2.5 fill-green-300" viewBox="0 0 6 6" aria-hidden="true">
                  <circle cx="3" cy="3" r="3"/>
                </svg>
                {{$product->descuento}}% Descuento
              </h5>
            @endif
          </div>
          <!-- Fin Description  y descuento-->
          @if($product->units)
            <!-- Colors -->
            <form class="mt-6">
              <h3 class="text-sm text-gray-600">Color</h3>
              <fieldset aria-label="Choose a color" class="mt-2">
                <div class="flex items-center gap-x-3">
                  <!-- Active and Checked: "ring ring-offset-1" -->
                  <label aria-label="Washed Black"
                         class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-700 focus:outline-none">
                    <input type="radio" name="color-choice" value="Washed Black" class="sr-only">
                    <span aria-hidden="true"
                          class="size-8 rounded-full border border-black/10 bg-gray-700"></span>
                  </label>
                  <!-- Active and Checked: "ring ring-offset-1" -->
                  <label aria-label="White"
                         class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-400 focus:outline-none">
                    <input type="radio" name="color-choice" value="White" class="sr-only">
                    <span aria-hidden="true"
                          class="size-8 rounded-full border border-black/10 bg-white"></span>
                  </label>
                  <!-- Active and Checked: "ring ring-offset-1" -->
                  <label aria-label="Washed Gray"
                         class="relative -m-0.5 flex cursor-pointer items-center justify-center rounded-full p-0.5 ring-gray-500 focus:outline-none">
                    <input type="radio" name="color-choice" value="Washed Gray" class="sr-only">
                    <span aria-hidden="true"
                          class="size-8 rounded-full border border-black/10 bg-gray-500"></span>
                  </label>
                </div>
              </fieldset>
            </form>
            <!-- Fin Colors -->
          @endif
          <div class="mt-10 flex justify-center items-center">
            <!-- Botón Add to Bag y Corazón Favoritos -->
            @if($product->units)
              <!-- Botón Add to Bag -->
              <a href="{{ route('product.buyit', $product) }}"
                 class=" flex max-w-xs flex-1 items-center justify-center rounded-md border border-transparent
                     bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none
                     focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50 sm:w-full">
                Add to bag
              </a>
              <!--Fin Botón Add to Bag -->
            @else
              <!-- Aviso Out of Stock -->
              <p class="pointer-events-none flex max-w-xs items-center justify-center rounded-md border border-transparent
                     bg-red-600 px-8 py-3 text-base font-medium text-white sm:w-full">
                {{ __('Out of Stock') }}
              </p>
              <!-- Fin Aviso Out of Stock -->
            @endif
            <!-- Corazón Favoritos -->
            <button type="button" data-id="{{ $product->id }}"
                    class="favorite-btn ml-4 flex items-center justify-center rounded-md px-3 py-3 text-gray-400 hover:bg-gray-100 hover:text-gray-500">
              <x-heroicon-m-heart
                class="h-6 w-6 {{ $enFavorites ? 'text-green-500':'' }}"></x-heroicon-m-heart>
              <span class="sr-only">Add to favorites</span>
            </button>
            <!-- Fin Corazón Favoritos -->
          </div>
        </div>
        <!--  FinProduct info --->
      </div>
  </section>
  <!-- ## Sección Detalles, Categorías y Etiquetas ## ## -->
  <section aria-labelledby="details-heading" class="mt-12 grid sm:grid-cols-[repeat(auto-fit,minmax(0,1fr))] gap-12">
    <!-- Detalles Adicionales -->
    <div>
      <h2 id="details-heading" class="pb-2">{{ __('Additional details') }}</h2>
      @foreach($product->featuretitles as $feature)
        <div
          class="border-t-gray-200 border-t pb-4 overflow-hidden especificaciones transition ease-linear duration-1500 ">
          
          <!-- Expand/collapse question button -->
          <button type="button"
                  class="cursor-pointer group relative flex w-full items-center justify-between py-2 my-4 "
                  aria-controls="disclosure-1" aria-expanded="false">
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
            {!! $feature->text !!}
          </div>
        </div>
      @endforeach
    </div>
    <!-- Fin Detalles Adicionales -->
    <!-- Categorías y Etiquetas -->
    <div>
      <h2 id="details-heading" class="">{{ __('Categories') }}</h2>
      @php
        $categs=[];
      @endphp
      
      <div class="grid gap-4 grid-cols-2">
        @foreach($product->categories as $category)
          <div class="divide-y divide-gray-200 border-t">
            <a href="{{url('/?category='.$category->id).'&categ_name='.$category->name}}">
              <div class="flex min-h-8 items-center gap-1 w-full py-1 px-1 rounded text-xs"
                   style="background:{{ $category->bgcolor }}; color:{{$category->color}}">
                @if($category->icon_active)
                  <div class="mr-1" style="color:{{$category->color}}">
                    {!! $category->icon !!}
                  </div>
                @elseif($category->image)
                  <img src="{{asset($category->image)}}" class="w-6 rounded-full">
                @endif
                <p class="m-auto">{{ $category->name }}</p>
              </div>
            </a>
            <div class="grid sm:grid-cols-3 gap-1">
              @foreach($product->tags as $tag)
                @if($tag->category_id === $category->id)
                  <a href="{{url('/?tag='.$tag->id.'&tag_name='.$tag->name)}}">
                    <div
                      class="flex justify-center items-center gap-1 min-w-fit  w-full py-1 px-1 ml-4 mt-[2px] rounded"
                      style="background:{{ $tag->bgcolor }}">
                      @if($tag->icon_active)
                        <div style="color:{{$tag->color}}">{!!$tag->icon!!}</div>
                      @elseif($tag->image)
                        <img src="{{asset($tag->image)}}" class="w-6 rounded-full">
                      @endif
                      <p class="text-[10px] px-2 py-1 m-auto rounded"
                         style="color:{{$tag->color}}"> {{ $tag->name }}</p>
                    </div>
                  </a>
                @endif
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    </div>
    <!-- Fin Categorías y Etiquetas -->
  </section>
  <!-- ## Fin Sección Detalles, Categorías y Etiquetas ## ## -->
  <!-- Imágenes Adicionales-->
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
                class="inline-flex items-center gap-x-1.5 rounded-md bg-green-600 px-2 py-1 text-xs font-medium text-green-50 ring-1 ring-inset ring-green-500"><svg
                  class="size-1.5 fill-green-50" viewBox="0 0 6 6" aria-hidden="true">  <circle cx="3"
                                                                                                cy="3"
                                                                                                r="3"/> </svg>
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
  <!-- Fin Imágenes Adicionales -->
  </main>
</x-layouts.app>
<!-- JavaScript -->
<script src="{{asset('js/favorites.js')}}"></script>
<script src="{{asset('js/show-product.js')}}"></script>
