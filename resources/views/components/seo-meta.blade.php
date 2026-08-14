@php
    $setting = \App\Models\WebsiteSetting::first();
    $siteName = $setting?->nama_website ?: 'SIP Bongki';
    $kelurahanName = $setting?->nama_kelurahan ?: 'Kelurahan Bongki';

    $defaultTitle = "{$siteName} - {$kelurahanName}";
    $defaultDescription = $setting?->deskripsi 
        ?: "Portal resmi {$kelurahanName}, Sinjai Utara. Layanan administrasi surat online, pengaduan warga, data kependudukan, dan informasi publik.";
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

    $rawDescription = View::hasSection('seo_description') ? View::getSection('seo_description') : $defaultDescription;
    $description = \Illuminate\Support\Str::limit(trim(preg_replace('/\s+/', ' ', strip_tags($rawDescription))), 155);
    $keywords = View::hasSection('seo_keywords') ? View::getSection('seo_keywords') : $defaultKeywords;
    $image = View::hasSection('seo_image') ? View::getSection('seo_image') : $defaultImage;
    $type = View::hasSection('seo_type') ? View::getSection('seo_type') : 'website';
    $publishedTime = View::hasSection('seo_published_time') ? View::getSection('seo_published_time') : null;
    $author = View::hasSection('seo_author') ? View::getSection('seo_author') : $kelurahanName;
    $url = url()->current();
@endphp

<!-- Primary Meta Tags -->
<title>{{ $title }}</title>
<meta name="title" content="{{ $title }}">
<meta name="description" content="{{ $description }}">
@if($keywords)
<meta name="keywords" content="{{ $keywords }}">
@endif
<meta name="author" content="{{ $author }}">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="{{ $type }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="id_ID">
<meta property="og:url" content="{{ $url }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
@if($image)
<meta property="og:image" content="{{ $image }}">
<meta property="og:image:alt" content="{{ $title }}">
@endif
@if($publishedTime && $type === 'article')
<meta property="article:published_time" content="{{ $publishedTime }}">
<meta property="article:author" content="{{ $author }}">
@endif

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="{{ $url }}">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
@if($image)
<meta name="twitter:image" content="{{ $image }}">
@endif