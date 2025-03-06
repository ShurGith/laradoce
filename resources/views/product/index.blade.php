<x-layouts.app :meta-title="isset($title )? $title . ' - ' .config('app.name') : config('app.name')"
               :header-text="isset($title) ? $title . ' - ' .config('app.name') : config('app.name')">

    <x-products-list :products="$products"/>

</x-layouts.app>
