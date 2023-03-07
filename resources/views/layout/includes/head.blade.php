<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link rel="icon" type="image/png" sizes="16x16" href="assets/demo/favicon.png">
<title>{{ session('title') }}</title>
<link href="{{ asset('asset/css/material-icons.css') }}" rel="stylesheet" type="text/css">
{{-- <link href="{{ asset('asset/css/monosocialiconsfont.css') }}" rel="stylesheet" type="text/css"> --}}
<link rel="preload" href="{{ asset('asset/css/monosocialiconsfont.css') }}"
    as="style" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"
    as="style" onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.1.3/mediaelementplayer.min.css"
    as="style" onload="this.onload=null;this.rel='stylesheet'">
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/0.7.0/css/perfect-scrollbar.min.css"
    rel="stylesheet" type="text/css">
<link rel="preload" href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700" as="style"
    onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700" as="style"
    onload="this.onload=null;this.rel='stylesheet'">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600" rel="stylesheet" type="text/css">
<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" as="style"
    onload="this.onload=null;this.rel='stylesheet'">
<link rel="preload" href="{{ asset('asset/css/style.css') }}" as="style"
    onload="this.onload=null;this.rel='stylesheet'">
<noscript>
    <link rel="stylesheet" href="{{ asset('asset/css/monosocialiconsfont.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.1.3/mediaelementplayer.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,600,700">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('asset/css/style.css') }}">
</noscript>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" async></script>
