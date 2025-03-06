@session('success')
<div class="rounded-md w-full max-w-[600px] bg-green-50 p-4 flex items-center justify-evenly">
  <div class="flex items-center gap-2 ">
    <x-heroicon-c-information-circle class="text-green-800 h-12 w-12"/>
    <p class="text-sm font-medium text-green-800">{{__($value) }}</p>
  </div>
  <div class="-mx-1.5 -my-1.5">
    <button type="button"
            class="inline-flex rounded-md bg-green-50 p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-green-600 focus:ring-offset-2 focus:ring-offset-green-50">
      <span class="sr-only">Dismiss</span>
      <x-heroicon-c-x-mark class="text-green-500 h-8 w-8"/>
    </button>
  </div>
</div>
</div>
@endsession

@session('error')
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {{ __($value)  }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endsession

@session('warning')
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  {{ __($value)  }}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endsession

@session('info')
<div class="rounded-md w-full max-w-[600px] bg-blue-50 p-4 flex items-center justify-evenly">
  <div class="flex items-center gap-2 ">
    <x-heroicon-c-information-circle class="text-blue-800 h-14 w-14"/>
    <div class="ml-3">
      <p class="text-sm font-medium text-blue-800">{{ __($value)  }}</p>
    </div>
    <div class="ml-auto pl-3">
      <div class="-mx-1.5 -my-1.5">
        <button type="button"
                class="inline-flex rounded-md bg-blue-50 p-1.5 text-blue-500 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-blue-50">
          <span class="sr-only">Dismiss</span>
          <x-heroicon-o-x-mark class="text-blue-800 h-8 w-8"/>
        </button>
      </div>
    </div>
  </div>
</div>
@endsession

@session('eliminado')
<div class="rounded-md w-full max-w-[600px] bg-orange-50 p-4 flex items-center justify-evenly">
  <div class="flex items-center gap-2 ">
    <x-heroicon-o-archive-box-x-mark class="text-orange-800 h-10 w-10"/>
    <div class="ml-3">
      <p class="text-sm font-medium text-orange-800">{{ __($value)  }}</p>
    </div>
    <div class="ml-auto pl-3">
      <div class="-mx-1.5 -my-1.5">
        <button type="button"
                class="inline-flex rounded-md bg-orange-50 p-1.5 text-orange-500 hover:bg-orange-100 focus:outline-none focus:ring-2 focus:ring-orange-600 focus:ring-offset-2 focus:ring-offset-orange-50">
          <span class="sr-only">Dismiss</span>
          <x-heroicon-o-x-mark class="text-orange-800 h-8 w-8"/>
        </button>
      </div>
    </div>
  </div>
</div>
@endsession
@if ($errors->any())
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ __('Please check the form below for errors') }}</strong>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
