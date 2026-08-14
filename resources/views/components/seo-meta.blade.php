@php
    $setting = \App\Models\WebsiteSetting::first();
    $siteName = $setting?->nama_website ?: 'SIP Bongki';
    $kelurahanName = $setting?->nama_kelurahan ?: 'Kelurahan Bongki';

    $defaultTitle = "{$siteName} | Sistem Informasi dan Pelayanan {$kelurahanName}";
    $defaultDescription = $setting?->deskripsi 
        ?: "Website resmi {$kelurahanName} yang menyediakan layanan publik digital, statistik kependudukan, berita, agenda, pengumuman, galeri, dan informasi pemerintahan.";
    $defaultKeywords = "{$kelurahanName}, {$siteName}, Pelayanan Publik, Sinjai Utara, Sinjai";
    $defaultImage = asset('images/meta.png');

    if (View::hasSection('seo_title')) {
        $rawTitle = View::getSection('seo_title');
        $title = str_contains($rawTitle, $siteName) ? $rawTitle : "{$rawTitle} | {$siteName}";
    } elseif (View::hasSection('title')) {
        $rawTitle = View::getSection('title');
        $title = str_contains($rawTitle, $siteName) ? $rawTitle : "{$rawTitle} | {$siteName}";
    } else {
        $title = $defaultTitle;
    }

    $description = View::hasSection('seo_description') ? View::getSection('seo_description') : $defaultDescription;
    $keywords = View::hasSection('seo_keywords') ? View::getSection('seo_keywords') : $defaultKeywords;
    $image = View::hasSection('seo_image') ? View::getSection('seo_image') : $defaultImage;
    $type = View::hasSection('seo_type') ? View::getSection('seo_type') : 'website';
    $url = url()->current();
@endphp

<!-- Primary Meta Tags -->
<title>{{ $title }}</title>
<meta name="title" content="{{ $title }}">
<meta name="description" content="{{ $description }}">
@if($keywords)
<meta name="keywords" content="{{ $keywords }}">
@endif

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
@if($image)
<meta property="og:image" content="{{ $image }}">
@endif

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ $url }}">
<meta property="twitter:title" content="{{ $title }}">
<meta property="twitter:description" content="{{ $description }}">
@if($image)
<meta property="twitter:image" content="{{ $image }}">
@endif