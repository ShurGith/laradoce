@php
  function enteros($valor) {
    $formatPrecio = number_format($valor / 100, 2, "'", ".");
    return substr($formatPrecio,0, strpos($formatPrecio,"'" )+1);
  }
    function decimales($valor) {
    $formatPrecio = number_format($valor / 100, 2, "'", ".");
    return substr($formatPrecio, -2);
  }
@endphp