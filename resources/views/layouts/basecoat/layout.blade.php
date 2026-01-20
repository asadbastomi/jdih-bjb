<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.basecoat.head')
    <title>@yield('title') - Jaringan Dokumentasi dan Informasi Hukum Kota Banjarbaru</title>
</head>

<body class="min-h-[100dvh] flex flex-col">
    @include('layouts.basecoat.navbar')

    <div class="fixed -z-10 h-[100dvh] w-full bg-white">
        <div
            class="absolute h-full w-full bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:16px_16px] [mask-image:radial-gradient(ellipse_50%_50%_at_50%_50%,#000_70%,transparent_100%)]">
        </div>
    </div>

    <main class="px-4 lg:px-6 py-10 mx-auto w-full flex-grow flex-shrink-0">
        @yield('content')
    </main>
    
    @include('public.footer')
</body>

</html>
