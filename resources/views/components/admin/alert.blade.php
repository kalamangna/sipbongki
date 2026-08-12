@if(session('success'))
    <div id="alert-success" class="flex items-center p-4 mb-4 text-green-800 rounded-2xl bg-green-50 border border-green-200 auto-dismiss shadow-sm" role="alert">
        <i class="fa-solid fa-circle-check text-green-600 mr-3 text-lg"></i>
        <div class="text-sm font-medium">
            {{ session('success') }}
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-100 inline-flex items-center justify-center h-8 w-8 transition-colors" data-dismiss-target="#alert-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

@if(session('error'))
    <div id="alert-error" class="flex items-center p-4 mb-4 text-rose-800 rounded-2xl bg-rose-50 border border-rose-200 shadow-sm" role="alert">
        <i class="fa-solid fa-circle-exclamation text-rose-600 mr-3 text-lg"></i>
        <div class="text-sm font-medium">
            {{ session('error') }}
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-rose-50 text-rose-500 rounded-lg focus:ring-2 focus:ring-rose-400 p-1.5 hover:bg-rose-100 inline-flex items-center justify-center h-8 w-8 transition-colors" data-dismiss-target="#alert-error" aria-label="Close">
            <span class="sr-only">Close</span>
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

@if(session('warning'))
    <div id="alert-warning" class="flex items-center p-4 mb-4 text-amber-800 rounded-2xl bg-amber-50 border border-amber-200 shadow-sm" role="alert">
        <i class="fa-solid fa-triangle-exclamation text-amber-600 mr-3 text-lg"></i>
        <div class="text-sm font-medium">
            {{ session('warning') }}
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-amber-50 text-amber-500 rounded-lg focus:ring-2 focus:ring-amber-400 p-1.5 hover:bg-amber-100 inline-flex items-center justify-center h-8 w-8 transition-colors" data-dismiss-target="#alert-warning" aria-label="Close">
            <span class="sr-only">Close</span>
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

@if(session('info'))
    <div id="alert-info" class="flex items-center p-4 mb-4 text-sky-800 rounded-2xl bg-sky-50 border border-sky-200 auto-dismiss shadow-sm" role="alert">
        <i class="fa-solid fa-circle-info text-sky-600 mr-3 text-lg"></i>
        <div class="text-sm font-medium">
            {{ session('info') }}
        </div>
        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-sky-50 text-sky-500 rounded-lg focus:ring-2 focus:ring-sky-400 p-1.5 hover:bg-sky-100 inline-flex items-center justify-center h-8 w-8 transition-colors" data-dismiss-target="#alert-info" aria-label="Close">
            <span class="sr-only">Close</span>
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.auto-dismiss').forEach(function (alert) {
        setTimeout(function () {
            // Find the dismiss button and trigger click to use Flowbite's native dismiss animation
            const closeBtn = alert.querySelector('[data-dismiss-target]');
            if (closeBtn) closeBtn.click();
        }, 1500);
    });
});
</script>