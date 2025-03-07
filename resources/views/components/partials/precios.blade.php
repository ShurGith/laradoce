@props(["textOriginal"=>"text-sm", "textFinal" => "text-base"])

<div class="flex justify-center items-center gap-x-8">
    @if($product->oferta)
        <h4 class="line-through {{$textOriginal}} font-medium text-gray-900">{{ $product->precios( false ) }}
            <span
                class="text-xs pl-1 align-super  ">{{ $product->precios( false, true ) }}</span> €
        </h4>
    @endif
    <h4 class="{{$textFinal}} font-medium text-gray-900">{{ $product->precios(true) }}<span
            class="text-xs pl-1 align-super  ">{{ $product->precios(true,true) }}</span>
        €</h4>
</div>
