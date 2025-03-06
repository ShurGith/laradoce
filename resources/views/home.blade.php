<x-layouts.app :meta-title="'Home'" :header-text="'Home'">
    <div class="">
        <h3 class="mb-4 text-xl">{{ __('Last Products') }}</h3>
        <x-products-list :products="$products" :title="$title"/>
    </div>

</x-layouts.app>
