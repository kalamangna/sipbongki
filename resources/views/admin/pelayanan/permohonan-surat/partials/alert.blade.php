@if(session('success'))

<div class="alert alert-success alert-dismissible fade show shadow-sm">

    <i class="fa-solid fa-circle-check me-2"></i>

    {{ session('success') }}

    <button
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>

@endif

@if(session('error'))

<div class="alert alert-danger alert-dismissible fade show shadow-sm">

    <i class="fa-solid fa-circle-exclamation me-2"></i>

    {{ session('error') }}

    <button
        class="btn-close"
        data-bs-dismiss="alert">
    </button>

</div>

@endif