<nav class="bg-gray-800 z-10 relative">
  <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="border-b border-gray-700">
      <div class="flex h-16 items-center justify-between px-4 sm:px-0">
        <div class="flex items-center">
          <div class="shrink-0">
            <img class="size-8"
                 src="https://tailwindui.com/plus-assets/img/logos/mark.svg?color=indigo&shade=500"
                 alt="Your Company"/>
          </div>
          <div class="md:block">
            <div class="ml-10 flex items-baseline space-x-4">
              <x-partials.nav-link href="{{ route('home') }}"
                                   :active="request()->routeIs('home')">{{  __('Home') }}</x-partials.nav-link>
              @auth
                @php
                  $url =  Auth::user()->isAdmin() ? '/admin/login':'/user';
                @endphp
                <a href="{{  url( Auth::user()->isAdmin() ? '/admin':'/user') }}"
                   class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Dashboard</a>
              @endauth
              <x-partials.nav-link href="{{ route('products.index') }}"
                                   :active="request()->routeIs('products.index')">{{  __('Productos') }}</x-partials.nav-link>
              <x-partials.nav-link href="{{ route('blog.index') }}"
                                   :active="request()->routeIs('blog.index')">{{  __('Blog') }}</x-partials.nav-link>
              <a href="#"
                 class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Calendar</a>
              <a href="#"
                 class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Reports</a>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            @php
              $myc = json_decode(request()->cookie('cookie_favorites', '[]'), true);
              if($myc)
                 $favos = count($myc);
              else
               $favos=false;
            @endphp
            <div id="div-favorites" class="relative {{ $favos ? '': 'hidden' }}">
              <a href="{{route('favorites')}}">
                <div
                  class="absolute -left-2 -top-2 bg-white rounded-full w-4 h-4 flex  justify-center items-center">
                  <p class="text-black text-xs contador">{{$favos}}</p>
                </div>
                <svg class="size-6 shrink-0 text-gray-300 {{ $favos ?? 'hidden'}} " fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor"
                     aria-hidden="true" data-slot="icon">
                  <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                </svg>
              </a>
            </div>
            <!-- Notificaciones -->
            <button type="button"
                    class="relative rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white">
              <span class="absolute -inset-1.5"></span>
              <span class="sr-only">View notifications</span>
              <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                   aria-hidden="true" data-slot="icon">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
              </svg>
            </button>
            <!-- Profile dropdown -->
            <div class="relative ml-3">
              @auth
                <div>
                  <button type="button"
                          class="relative flex max-w-xs items-center rounded-full bg-gray-800 text-sm"
                          id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                    <img id="imag-menu" class="size-8 rounded-full"
                         src="{{  Auth::user()->getFilamentAvatarUrl() ?? Avatar::create( Auth::user()->name)->toBase64()  }}"
                         alt="">
                  </button>
                </div>
              @endauth
              @guest
                <a href="{{  url( '/login') }}"
                   class="rounded-md px-3 py-2 text-sm font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Login</a>
              @endguest
              @auth
                <div id="mainmenu"
                     class="transform duration-300 opacity-0 scale-95 absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black/5 focus:outline-none"
                     role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button"
                     tabindex="-1">
                  <div class="flex flex-col items-start justify-start gap-2 my-2">
                    <a href="{{ route('settings.profile') }}" class="flex gap-1 pl-4 text-sm text-gray-700"
                       role="menuitem" tabindex="-1"
                       id="user-menu-item-0">
                      <x-heroicon-o-user class="size-5"/>
                      {{__('Your Profile')}}</a>
                    <form action="{{route('logout')}}" method="post">
                      @csrf
                      <button type="submit" style=";" class="cursor-pointer flex gap-1 pl-4 text-sm text-gray-700">
                          <span
                            class="flex items-center gap-1 fi-dropdown-list-item-label flex-1 truncate text-start text-gray-700 dark:text-gray-200"
                            style="">
                                @auth()
                              <x-heroicon-o-arrow-right-end-on-rectangle class="size-5"/>
                              {{  __('Sign out') }}
                            @endauth
                            @guest
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                   stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path
                                  stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3  3m3-3H2.25"/>
                              </svg>
                              Signin
                            @endguest
                              </span>
                      </button>
                    </form>
                    @php
                      $idioma =  array_key_exists(session('locale'),config('languages')) ? session('locale') : Config('app.locale');
                    @endphp
                    @foreach (config('languages') as $key => $value)
                      @if ($key != $idioma)
                        <a class="flex gap-2 px-4 py-2 text-sm text-gray-700"
                           href="{{ route('lang', $key) }}">
                          <x-heroicon-o-flag class="size-5"/> {{ $value }}</a>
                      @endif
                    @endforeach
                  </div>
                </div>
                <div class="-mr-2 flex md:hidden">
                  <!-- Mobile menu button -->
                  <button type="button"
                          class="relative inline-flex items-center justify-center rounded-md bg-gray-800 p-2 text-gray-400 hover:bg-gray-700 hover:text-white"
                          aria-controls="mobile-menu" aria-expanded="false">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only">Open main menu</span>
                    <!-- Menu open: "hidden", Menu closed: "block" -->
                    <svg class="block size-6" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         aria-hidden="true" data-slot="icon">
                      <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                    <!-- Menu open: "block", Menu closed: "hidden" -->
                    <svg class="hidden size-6" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5"
                         stroke="currentColor"
                         aria-hidden="true" data-slot="icon">
                      <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18 18 6M6 6l12 12"/>
                    </svg>
                  </button>
                </div>
              @endauth
              <!-- Mobile menu, show/hide based on menu state. -->
              <div class="border-b border-gray-700 md:hidden" id="mobile-menu">
                <div class="space-y-1 px-2 py-3 sm:px-3">
                  <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
                  <a href="#"
                     class="block rounded-md bg-gray-900 px-3 py-2 text-base font-medium text-white"
                     aria-current="page">Dashboard</a>
                  <a href="#"
                     class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Team</a>
                  <a href="#"
                     class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Projects</a>
                  <a href="#"
                     class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Calendar</a>
                  <a href="#"
                     class="block rounded-md px-3 py-2 text-base font-medium text-gray-300 hover:bg-gray-700 hover:text-white">Reports</a>
                </div>
                <div class="border-t border-gray-700 pb-3 pt-4">
                  <div class="flex items-center px-5">
                    <div class="shrink-0">
                      <img class="size-10 rounded-full"
                           src=""
                           alt="">
                    </div>
                    <div class="ml-3">
                      <div class="text-base/5 font-medium text-white">Tom Cook</div>
                      <div class="text-sm font-medium text-gray-400">tom@example.com</div>
                    </div>
                    <button type="button"
                            class="relative ml-auto shrink-0 rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white">
                      <span class="absolute -inset-1.5"></span>
                      <span class="sr-only">View notifications</span>
                      <svg class="size-6" fill="none" viewBox="0 0 24 24"
                           stroke-width="1.5" stroke="currentColor"
                           aria-hidden="true" data-slot="icon">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                      </svg>
                    </button>
                  </div>
                  <div class="mt-3 space-y-1 px-2">
                    <a href="#"
                       class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Your
                      Profile</a>
                    <a href="#"
                       class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Settings</a>
                    <a href="#"
                       class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-gray-700 hover:text-white">Sign
                      out</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div id="flashMessage"
       class="fixed w-full flex top-20 justify-end items-end overflow-x-hidden ">
    <div class=" flex justify-center translate-x-full transition-all duration-500">
      @include('components.layouts.flash-messages')
      @if(strpos($_SERVER['REQUEST_URI'], '/products/') !== false)
        <x-layouts.flash-unic :message="$message"/>
      @endif
    </div>
  </div>
</nav>