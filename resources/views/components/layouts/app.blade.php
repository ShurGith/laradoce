@props([
'metaTitle' => 'Home'
])
  <!DOCTYPE html>
<html class="h-full bg-gray-100" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  
  <meta name="application-name" content="{{ config('app.name') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name').'-'. $metaTitle ?? "Live" }}</title>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
  
  @php
    if(isset($css)){
    echo '<link rel="stylesheet" href="../css/show.css">';
    }
  @endphp
    <!-- Styles / Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  
  @filamentStyles
</head>
<body class="antialiased grid min-h-dvh grid-rows-[auto_1fr_auto]">
<div class="bg-gray-800 pb-32">
  <x-navigation :message="$metaTitle"/>
  <header class="py-10">
    <div class="flex flex-col mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <h1 class="text-2xl font-bold tracking-tight text-white">{{ $headerText ??''}}</h1>
      <button type="button"
              class="ml-44 max-w-fit mt-2 flex items-center gap-x-1.5 rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 {{ (!Request::get('tag') && !Request::get('category')) ? 'hidden' : ''}} "
              onclick=" history.back()">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="m11.25 9-3 3m0 0 3 3m-3-3h7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
        </svg>
        Volver
      </button>
    </div>
  </header>
</div>
<main class="-mt-32">
  <div class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
    <div class="rounded-lg bg-white py-6 shadow sm:px-6 ">
      {{ $slot }}
    </div>
  </div>
</main>
<x-footer/>
@filamentScripts
<script src="../js/code.js"></script>
</body>
</html>