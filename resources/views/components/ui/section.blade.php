@props([
    'title' => null,
    'subtitle' => null
])

<section class="mb-4">

    @if($title)

        <div class="mb-3">

            <h4 class="fw-bold mb-1">

                {{ $title }}

            </h4>

            @if($subtitle)

                <p class="text-muted mb-0">

                    {{ $subtitle }}

                </p>

            @endif

        </div>

    @endif

    {{ $slot }}

</section>