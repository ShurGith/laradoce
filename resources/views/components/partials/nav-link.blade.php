@props(['active' => false])
<a
  class="{{ $active?'bg-gray-900 border-b rounded-none rounded-t-md rounde text-white ': ' ' }} text-white px-4 py-2 rounded-md text-xs hover:text-slate-100 transition duration-300 hover:bg-gray-500"
  {{ $attributes }}>{{$slot}}</a>
<!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->