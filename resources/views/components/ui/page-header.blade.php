@props([
    'title',
    'subtitle' => '',
])

<div class="page-header d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

    <div>

        <h2 class="page-title mb-1">

            {{ $title }}

        </h2>

        @if($subtitle)

            <p class="page-subtitle mb-0">

                {{ $subtitle }}

            </p>

        @endif

    </div>

    <div>

        {{ $slot }}

    </div>

</div>