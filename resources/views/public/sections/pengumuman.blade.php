<section id="pengumuman" class="pengumuman-section home-zone zone-primary">

    <div class="container">

    {{-- HEADER --}}
    <div class="text-center mb-5">

    <span class="section-badge">
        Pengumuman
    </span>

   
    <p class="section-description">
        Informasi resmi Pemerintah Kelurahan Bongki.
    </p>

</div>
    {{-- LIST --}}
    <div class="row g-4">

        @forelse($pengumumen as $pengumuman)

        <div class="col-lg-4 col-md-6">

            <article class="pengumuman-card">

                <div class="pengumuman-top">

                    <span class="pengumuman-date">
                        {{ $pengumuman->tanggal_publish?->translatedFormat('d F Y') ?? '-' }}
                    </span>

                </div>

                <h4>
    <a href="{{ route('pengumuman.detail', $pengumuman->slug) }}"
       class="text-decoration-none">

        {{ $pengumuman->judul }}

    </a>
</h4>

                <p>
                    {{ \Illuminate\Support\Str::limit(strip_tags($pengumuman->isi), 120) }}
                </p>

                <div class="pengumuman-footer">

    <a href="{{ route('pengumuman.detail', $pengumuman->slug) }}">
        Baca Selengkapnya
        <i class="bi bi-arrow-right"></i>
    </a>

</div>

            </article>

        </div>

        @empty

        <div class="col-12 text-center">

            <div class="alert alert-light border">

                Belum ada pengumuman.

            </div>

        </div>

        @endforelse

    </div>

</div>

</section>