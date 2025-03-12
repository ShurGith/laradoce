<div class="fav-show-add w-full max-w-[600px] rounded-tl rounded-bl  bg-green-50 p-4 flex items-center justify-evenly">
  <div class="flex items-center gap-2 ">
    <x-heroicon-c-information-circle class="text-green-800 h-12 w-12"/>
    <p class="text-sm font-medium text-green-800">
      <span class="font-bold span-add"></span>{{ $message }} {{ __('has been added to favourites list.') }}</p>
  </div>
</div>
<div
  class="fav-show-remove rounded-tl rounded-bl hidden w-full max-w-[600px] bg-red-50 p-4 flex items-center justify-evenly">
  <div class="flex items-center gap-2 ">
    <x-heroicon-c-information-circle class="text-red-800 h-12 w-12"/>
    <p class="text-sm font-medium text-red-800">
      <span class="font-bold span-remove"></span>{{ $message }} {{ __(' has been removed from favourites') }}</p>
  </div>
</div>
