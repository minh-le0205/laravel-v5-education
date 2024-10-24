@php
    $pageTitle = '';
    if (!empty($title)) {
        $pageTitle = $title;
    }
@endphp
<title>{{ $pageTitle }}</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Tech Mag template project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="{{ asset('news/images/favicons.png" rel="icon" type="image/x-icon') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('news/css/bootstrap-4.1.2/bootstrap.min.css') }}">
<link href="{{ asset('news/css/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{ asset('news/js/OwlCarousel2-2.2.1/owl.carousel.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('news/js/OwlCarousel2-2.2.1/owl.theme.default.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('news/js/OwlCarousel2-2.2.1/animate.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('news/css/combine-all.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('news/css/dropdown.css') }}">
