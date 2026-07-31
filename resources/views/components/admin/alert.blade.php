@if(session('success'))
    <div
        id="globalAlert"
        class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4"
        role="alert">

        <i class="fa-solid fa-circle-check me-2"></i>

        {{ session('success') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>

    </div>
@endif

@if(session('error'))
    <div
        id="globalAlert"
        class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4"
        role="alert">

        <i class="fa-solid fa-circle-exclamation me-2"></i>

        {{ session('error') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>

    </div>
@endif

@if(session('warning'))
    <div
        id="globalAlert"
        class="alert alert-warning alert-dismissible fade show border-0 shadow-sm mb-4"
        role="alert">

        <i class="fa-solid fa-triangle-exclamation me-2"></i>

        {{ session('warning') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>

    </div>
@endif

@if(session('info'))
    <div
        id="globalAlert"
        class="alert alert-info alert-dismissible fade show border-0 shadow-sm mb-4"
        role="alert">

        <i class="fa-solid fa-circle-info me-2"></i>

        {{ session('info') }}

        <button
            type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>

    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.alert').forEach(function (alert) {

        setTimeout(function () {

            alert.classList.remove('show');

            setTimeout(function () {
                alert.remove();
            }, 300);

        }, 3000);

    });

});
</script>