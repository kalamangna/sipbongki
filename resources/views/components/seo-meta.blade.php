@php
    $defaultTitle = 'SIP Bongki | Sistem Informasi dan Pelayanan Kelurahan Bongki';
    $defaultDescription = 'Website resmi Kelurahan Bongki yang menyediakan layanan publik digital, statistik kependudukan, berita, agenda, pengumuman, galeri, dan informasi pemerintahan.';
    $defaultKeywords = 'Kelurahan Bongki, SIP Bongki, Pelayanan Publik, Sinjai Utara, Sinjai';
    $defaultImage = asset('images/meta.png');

    $title = View::hasSection('seo_title') ? View::getSection('seo_title') . ' | SIP Bongki' : $defaultTitle;
    $description = View::hasSection('seo_description') ? View::getSection('seo_description') : $defaultDescription;
    $keywords = View::hasSection('seo_keywords') ? View::getSection('seo_keywords') : $defaultKeywords;
    $image = View::hasSection('seo_image') ? View::getSection('seo_image') : $defaultImage;
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
<meta property="og:type" content="website">
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