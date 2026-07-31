@props([
'type'=>'primary'
])

<span class="badge bg-{{ $type }}">

{{ $slot }}

</span>