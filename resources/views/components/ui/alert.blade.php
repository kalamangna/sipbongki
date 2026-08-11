@props([
    'type'=>'success'
])

<div class="alert alert-{{ $type }} alert-dismissible fade show">

    {{ $slot }}

    <button
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>