{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    {{-- Beranda --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ now()->toIso8601String() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- Layanan Permohonan --}}
    <url>
        <loc>{{ route('permohonan.create') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- Pengaduan --}}
    <url>
        <loc>{{ route('pengaduan') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('pengaduan.status') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>

    {{-- Berita --}}
    @foreach($beritas as $berita)
    <url>
        <loc>{{ route('berita.show', $berita) }}</loc>
        <lastmod>{{ optional($berita->updated_at ?? $berita->tanggal_publish ?? $berita->created_at)->toIso8601String() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.8</priority>
    </url>
    @endforeach

    {{-- Pengumuman --}}
    @foreach($pengumumen as $pengumuman)
    <url>
        <loc>{{ route('pengumuman.detail', $pengumuman->slug) }}</loc>
        <lastmod>{{ optional($pengumuman->updated_at ?? $pengumuman->tanggal_publish ?? $pengumuman->created_at)->toIso8601String() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach
</urlset>
