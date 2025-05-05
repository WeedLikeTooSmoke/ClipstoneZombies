<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ $seo['description'] }}">
<meta name="keywords" content="{{ $seo['keywords'] }}">
<meta name="author" content="{{ $seo['author'] }}">
<meta name="robots" content="index, follow">
<title>{{ config('app.name') }} - {{ $page }}</title>
<link rel="canonical" href="{{ $domain }}/{{ $page }}">
<link rel="dns-prefetch" href="{{ $domain }}">

<meta property="og:title" content="{{ config('app.name') }}">
<meta property="og:description" content="{{ $seo['description'] }}">
<meta property="og:image" content="{{ $seo['image'] }}">
<meta property="og:url" content="{{ $domain }}">
<meta property="og:type" content="website">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ config('app.name') }}">
<meta name="twitter:description" content="{{ $seo['description'] }}">
<meta name="twitter:image" content="{{ $seo['image'] }}">
