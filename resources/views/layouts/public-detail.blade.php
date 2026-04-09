<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'JDIH Kota Banjarbaru')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', 'Jaringan Dokumentasi dan Informasi Hukum Kota Banjarbaru')">
    <meta name="author" content="Kota Banjarbaru" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    @include('public.partials.legal-detail-head-assets')
    @yield('head')
</head>

<body>
    @include('public.header')

    @yield('content')

    @include('public.footer')
    <a href="#" class="back-to-top" id="back-to-top"><i class="mdi mdi-chevron-up"></i></a>

    @include('public.partials.legal-detail-foot-assets')
    @yield('page-scripts')
</body>

</html>
