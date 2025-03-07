@php
    $rand = rand(3,5);
@endphp
<div class="mt-3 mx-auto">
    <h3 class="sr-only">Reviews</h3>
    <div class="flex items-center justify-center">
        @for($i=0; $i<$rand; $i++)
            <x-heroicon-m-star class="size-5 shrink-0 text-yellow-400"></x-heroicon-m-star>
        @endfor
        @for($i=0; $i<(5-$rand); $i++)
            <x-heroicon-o-star class="size-5 shrink-0 text-gray-300"></x-heroicon-o-star>
        @endfor
    </div>
</div>
