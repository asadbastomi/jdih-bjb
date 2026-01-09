<?php
setlocale(LC_TIME, 'id_ID');

// Possible Variables
// $jadwal: List of Legal Department Schedule

// $palingDiunduh: List of Most Downloaded Document (chart)
// $palingDicari: List of Most Searched Document (chart)
// $berlakudantidak: List of valid and invalid document (chart)
// $maxtahun: Maximal year for chart
// $mintahun: Minimal year for chart
// $pagesambutan: Page about welcome page
// $pagedasarhukum: Page about legal basis
// $linkTerkait: List of related link (other government websites)

// $popular_item: List of most popular legal products
// $slide: List of slides (usually banner or news)
// $kegiatan: List activities of government

// $totalperda: Total number of local regulations (Perda)
// $tahunanperda: Yearly number of local regulations (Perda)
// $totalperwal: Total number of mayor's regulations (Perwal)
// $tahunanperwal: Yearly number of mayor's regulations (Perwal)
// $totalkepwal: Total number of mayor's decisions (Kepwal)
// $tahunankepwal: Yearly number of mayor's decisions (Kepwal)
// $totalpropemperda: Total number of regional regulation formation program (Propemperda)
// $tahunanpropemperda: Yearly number of regional regulation formation program (Propemperda)
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Jaringan Dokumentasi dan Informasi Hukum Kota Banjarbaru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta
        content="Dalam pelaksanaan Jaringan Dokumentasi dan Informasi Hukum (JDIH) Kota Banjarbaru yang dikelola oleh Bagian Hukum dan Perundang-undangan."
        name="description" />
    <meta content="Kota Banjarbaru" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- TailwindCSS v4 CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom Styles -->
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 50%, #60a5fa 100%);
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .stats-counter {
            font-variant-numeric: tabular-nums;
        }

        /* Fix for hero section spacing */
        #beranda {
            min-height: 100vh;
            height: 100vh;
            padding-top: 6rem;
            padding-bottom: 6rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (min-width: 768px) {
            #beranda {
                padding-top: 7rem;
                padding-bottom: 5rem;
            }
        }

        @media (min-width: 1024px) {
            #beranda {
                padding-top: 8rem;
                padding-bottom: 6rem;
            }
        }

        /* Ensure header doesn't overlap content */
        header {
            z-index: 9999;
        }

        /* Smooth scrolling offset for anchor links */
        html {
            scroll-padding-top: 6rem;
            overflow-x: hidden;
        }

        /* Additional hero section fixes */
        #beranda .container {
            max-width: 100%;
            width: 100%;
        }

        /* Ensure proper content spacing */
        #beranda>.relative {
            width: 100%;
            height: 100%;
        }

        /* Ensure scroll indicator doesn't inherit unwanted styles */
        #beranda .animate-bounce {
            animation: bounce 1s infinite;
        }

        /* Add more spacing for scroll indicator */
        #beranda>.absolute.bottom-4 {
            bottom: 1.5rem;
        }

        @media (min-width: 768px) {
            #beranda>.absolute.bottom-4 {
                bottom: 2rem;
            }
        }

        @media (max-height: 700px) {
            #beranda {
                padding-bottom: 2rem;
            }
        }

        /* Mobile menu background fix */
        #mobile-menu {
            background: white !important;
            position: relative;
        }

        #mobile-menu>div {
            background: white !important;
            position: relative;
            z-index: 1;
        }

        .mobile-accordion>div {
            background: white;
        }
    </style>

    <!-- Elfsight Instagram Feed | JDIH Banjarbaru Instagram Feed -->
    <script src="https://static.elfsight.com/platform/platform.js" async></script>
    <!-- Use below script to load the widget -->
    <!-- <div class="elfsight-app-f5c95a62-512f-4563-b43b-d4100a0f0240" data-elfsight-app-lazy></div> -->

    <!-- Sienna Web Accessibility Widget -->
    <script src="https://website-widgets.pages.dev/dist/sienna.min.js" defer></script>
</head>

<body class="bg-gray-50 overflow-x-hidden">
    <!-- Header - Redesigned Modern Navbar -->
    <header class="fixed top-0 w-full bg-white/95 backdrop-blur-xl shadow-lg border-b border-gray-100/50"
        style="z-index: 9999;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo & Brand -->
                <div class="flex items-center">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo JDIH" class="h-10 md:h-12 md:w-auto">
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center space-x-1">
                    <a href="/"
                        class="px-4 py-2.5 text-sm font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300">
                        Beranda
                    </a>

                    <!-- Produk Hukum Dropdown -->
                    <div class="relative group">
                        <button
                            class="px-4 py-2.5 text-sm font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 flex items-center">
                            Produk Hukum
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div
                            class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <a href="/perda"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-t-lg">Peraturan
                                Daerah</a>
                            <a href="/perwal"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Peraturan
                                Wali Kota</a>
                            <a href="/keputusan-wali-kota"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-b-lg">Keputusan
                                Wali Kota</a>
                        </div>
                    </div>

                    <a href="/propemperda"
                        class="px-4 py-2.5 text-sm font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300">
                        Propemperda
                    </a>

                    <a href="/kegiatan"
                        class="px-4 py-2.5 text-sm font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300">
                        Kegiatan
                    </a>

                    <a href="/kontak"
                        class="px-4 py-2.5 text-sm font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300">
                        Kontak
                    </a>

                    <!-- Lainnya (More) Dropdown -->
                    <div class="relative group">
                        <button
                            class="px-4 py-2.5 text-sm font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 flex items-center">
                            Lainnya
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div
                            class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 max-h-96 overflow-y-auto">
                            <!-- Profil Section -->
                            <div class="border-b border-gray-100 pb-2 mb-2">
                                <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Profil</div>
                                <a href="/sambutan"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Sambutan
                                    Kabag. Hukum</a>
                                <a href="/visi-misi"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Visi
                                    Misi</a>
                                <a href="/makna-logo"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Makna
                                    Logo</a>
                                <a href="/sejarah-banjarbaru"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Sejarah
                                    Banjarbaru</a>
                                <a href="/sejarah"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Sejarah</a>
                                <a href="/tupoksi"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Tugas
                                    Pokok</a>
                                <a href="/tim-pengelola"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Tim
                                    Pengelola</a>
                                <a href="/sk"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">SK
                                    Tim JDIH</a>
                                <a href="/perwalipengelola"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Perwali
                                    Pengelolaan JDIH</a>
                                <a href="/susunan-organisasi"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Susunan
                                    Organisasi</a>
                                <a href="/galeri"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Galeri
                                    Foto</a>
                                <a href="/pustaka"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Pustaka
                                    JDIH</a>
                            </div>

                            <!-- Data Perkara Section -->
                            <div class="border-b border-gray-100 pb-2 mb-2">
                                <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Data
                                    Perkara</div>
                                <a href="/putusanpengadilan-negeri"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Putusan
                                    Pengadilan Negeri</a>
                                <a href="/putusanpengadilan-tu-negara"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Putusan
                                    Pengadilan TU Negara</a>
                            </div>

                            <!-- Informasi Section -->
                            <div class="border-b border-gray-100 pb-2 mb-2">
                                <div class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                    Informasi</div>
                                <a href="/artikel"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Artikel</a>
                                <a href="/inovasi"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Inovasi</a>
                                <a href="/pengumuman"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Relaas</a>
                                <a href="/monograf-hukum"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">Monografi
                                    Hukum</a>
                            </div>

                            <!-- Other Links -->
                            <a href="/faq"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600">FAQ</a>
                            <a href="/sop"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-b-lg">SOP</a>
                        </div>
                    </div>
                </nav>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button"
                    class="lg:hidden p-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 transition-colors duration-300">
                    <svg id="mobile-menu-icon" class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="lg:hidden hidden border-t border-gray-200 bg-white backdrop-blur-xl"
                style="background-color: rgba(255, 255, 255, 0.98);">
                <div class="px-4 py-6 space-y-2 bg-white"
                    style="max-height: calc(100vh - 80px); overflow-y: auto; -webkit-overflow-scrolling: touch; background-color: white;">
                    <a href="/"
                        class="block px-4 py-3 text-base font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300">Beranda</a>

                    <!-- Produk Hukum Accordion -->
                    <div class="mobile-accordion">
                        <button
                            class="w-full px-4 py-3 text-base font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 flex justify-between items-center"
                            onclick="toggleMobileDropdown('produk-menu')">
                            Produk Hukum
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="produk-menu" class="hidden pl-8 space-y-1 mt-2">
                            <a href="/perda"
                                class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Peraturan
                                Daerah</a>
                            <a href="/perwal"
                                class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Peraturan
                                Wali Kota</a>
                            <a href="/keputusan-wali-kota"
                                class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Keputusan
                                Wali Kota</a>
                        </div>
                    </div>

                    <a href="/propemperda"
                        class="block px-4 py-3 text-base font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300">Propemperda</a>
                    <a href="/kegiatan"
                        class="block px-4 py-3 text-base font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300">Kegiatan</a>
                    <a href="/kontak"
                        class="block px-4 py-3 text-base font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300">Kontak</a>

                    <!-- Lainnya Accordion -->
                    <div class="mobile-accordion">
                        <button
                            class="w-full px-4 py-3 text-base font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 flex justify-between items-center"
                            onclick="toggleMobileDropdown('lainnya-menu')">
                            Lainnya
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div id="lainnya-menu" class="hidden space-y-2 mt-2 bg-white rounded-lg">

                            <!-- Profil Sub-Accordion -->
                            <div class="mobile-accordion pl-4">
                                <button
                                    class="w-full px-4 py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 flex justify-between items-center"
                                    onclick="toggleMobileDropdown('profil-submenu')">
                                    Profil
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div id="profil-submenu" class="hidden pl-4 space-y-1 mt-1 bg-gray-50 rounded-lg py-2">
                                    <a href="/sambutan"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Sambutan
                                        Kabag. Hukum</a>
                                    <a href="/visi-misi"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Visi
                                        Misi</a>
                                    <a href="/makna-logo"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Makna
                                        Logo</a>
                                    <a href="/sejarah-banjarbaru"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Sejarah
                                        Banjarbaru</a>
                                    <a href="/sejarah"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Sejarah</a>
                                    <a href="/tupoksi"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Tugas
                                        Pokok</a>
                                    <a href="/tim-pengelola"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Tim
                                        Pengelola</a>
                                    <a href="/sk"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">SK
                                        Tim JDIH</a>
                                    <a href="/perwalipengelola"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Perwali
                                        Pengelolaan JDIH</a>
                                    <a href="/susunan-organisasi"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Susunan
                                        Organisasi</a>
                                    <a href="/galeri"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Galeri
                                        Foto</a>
                                    <a href="/pustaka"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Pustaka
                                        JDIH</a>
                                </div>
                            </div>

                            <!-- Data Perkara Sub-Accordion -->
                            <div class="mobile-accordion pl-4">
                                <button
                                    class="w-full px-4 py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 flex justify-between items-center"
                                    onclick="toggleMobileDropdown('perkara-submenu')">
                                    Data Perkara
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div id="perkara-submenu" class="hidden pl-4 space-y-1 mt-1 bg-gray-50 rounded-lg py-2">
                                    <a href="/putusanpengadilan-negeri"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Putusan
                                        Pengadilan Negeri</a>
                                    <a href="/putusanpengadilan-tu-negara"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Putusan
                                        Pengadilan TU Negara</a>
                                </div>
                            </div>

                            <!-- Informasi Sub-Accordion -->
                            <div class="mobile-accordion pl-4">
                                <button
                                    class="w-full px-4 py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all duration-300 flex justify-between items-center"
                                    onclick="toggleMobileDropdown('informasi-submenu')">
                                    Informasi
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div id="informasi-submenu"
                                    class="hidden pl-4 space-y-1 mt-1 bg-gray-50 rounded-lg py-2">
                                    <a href="/artikel"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Artikel</a>
                                    <a href="/inovasi"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Inovasi</a>
                                    <a href="/pengumuman"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Relaas</a>
                                    <a href="/monograf-hukum"
                                        class="block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">Monografi
                                        Hukum</a>
                                </div>
                            </div>

                            <!-- Direct Links -->
                            <a href="/faq"
                                class="block pl-8 px-4 py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">FAQ</a>
                            <a href="/sop"
                                class="block pl-8 px-4 py-2 text-sm font-semibold text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg">SOP</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section - Fixed Layout -->
    <section id="beranda" class="relative flex items-center justify-center overflow-hidden">
        <!-- Background with modern gradients -->
        <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900">
            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_30%_20%,_rgba(59,_130,_246,_0.3)_0%,_transparent_50%)] opacity-70">
            </div>
            <div
                class="absolute inset-0 bg-[radial-gradient(circle_at_70%_80%,_rgba(147,_51,_234,_0.3)_0%,_transparent_50%)] opacity-70">
            </div>
        </div>

        <!-- Floating elements - Fixed z-index -->
        <div class="absolute top-20 left-10 w-32 h-32 bg-blue-500/20 rounded-full blur-xl animate-pulse z-10"></div>
        <div class="absolute bottom-20 right-10 w-48 h-48 bg-purple-500/20 rounded-full blur-xl animate-bounce z-10"
            style="animation-duration: 3s;"></div>
        <div class="absolute top-1/2 left-1/4 w-24 h-24 bg-indigo-500/20 rounded-full blur-xl animate-ping z-10"></div>

        <div class="relative z-20 w-full">
            <div class="container mx-auto px-4 text-center">
                <!-- Trust Badge -->
                <div
                    class="inline-flex items-center bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-8 border border-white/20">
                    <div class="w-3 h-3 bg-green-400 rounded-full mr-3 animate-pulse"></div>
                    <span class="text-blue-200 text-sm font-semibold">🏛️ Platform Resmi Pemerintah</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-8 leading-tight">
                    <span class="text-white">Hub Informasi</span><br>
                    <span
                        class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">Hukum
                        Anda</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-lg md:text-xl lg:text-2xl text-gray-300 mb-12 max-w-4xl mx-auto leading-relaxed">
                    Akses dokumen hukum yang komprehensif, peraturan, dan informasi pemerintah dari
                    <span class="text-blue-400 font-semibold">Kota Banjarbaru</span> dalam satu platform digital terpadu
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center mb-16">
                    <a href="#produk-hukum"
                        class="group bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300 flex items-center space-x-3">
                        <span>📋 Jelajahi Produk Hukum</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                    <button onclick="document.getElementById('surveyPopup').classList.remove('hidden')"
                        class="group bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 flex items-center space-x-3">
                        <span>💬 Berikan Masukan</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                    </button>
                </div>

                <!-- Key Features -->
                <div class="hidden md:grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto mb-24">
                    <div
                        class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/10 transition-all duration-300">
                        <div class="text-blue-400 text-3xl mb-4">⚡</div>
                        <h3 class="text-xl font-bold text-white mb-2">Akses Real-time</h3>
                        <p class="text-gray-300 text-sm">Dapatkan akses instan ke dokumen hukum dan peraturan terbaru
                        </p>
                    </div>
                    <div
                        class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/10 transition-all duration-300">
                        <div class="text-purple-400 text-3xl mb-4">🔍</div>
                        <h3 class="text-xl font-bold text-white mb-2">Pencarian Cerdas</h3>
                        <p class="text-gray-300 text-sm">Kemampuan pencarian canggih untuk menemukan apa yang Anda
                            butuhkan</p>
                    </div>
                    <div
                        class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 border border-white/10 hover:bg-white/10 transition-all duration-300">
                        <div class="text-pink-400 text-3xl mb-4">📊</div>
                        <h3 class="text-xl font-bold text-white mb-2">Dashboard Analitik</h3>
                        <p class="text-gray-300 text-sm">Wawasan dan statistik komprehensif tentang dokumen hukum</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-2 sm:bottom-1 left-0 right-0 flex justify-center z-30">
            <div class="text-white animate-bounce flex flex-col items-center">
                <svg class="w-6 h-6 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
                <p class="text-sm text-gray-400 whitespace-nowrap">Scroll untuk menjelajahi</p>
            </div>
        </div>
    </section>

    <!-- Advanced Search Section -->
    <section class="relative py-24 bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 overflow-hidden">
        <!-- Background Elements -->
        <div
            class="absolute top-0 left-0 w-96 h-96 bg-blue-200/30 rounded-full blur-3xl -translate-x-48 -translate-y-48">
        </div>
        <div
            class="absolute bottom-0 right-0 w-96 h-96 bg-purple-200/30 rounded-full blur-3xl translate-x-48 translate-y-48">
        </div>

        <div class="relative z-10 container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <!-- Header -->
                <div class="text-center mb-16">
                    <div
                        class="inline-flex items-center bg-blue-100 text-blue-700 rounded-full px-6 py-3 mb-6 font-semibold">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span>Pencarian Canggih</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                        <span
                            class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent">Cari
                            Produk Hukum</span>
                    </h1>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                        Temukan peraturan, keputusan, dan dokumen hukum dengan sistem pencarian yang akurat dan mudah
                        digunakan
                    </p>
                </div>

                <!-- Search Form -->
                <div class="bg-white/70 backdrop-blur-xl rounded-3xl p-8 lg:p-12 shadow-2xl border border-white/20">
                    <!-- Main Search Input -->
                    <div class="mb-8">
                        <div class="relative">
                            <svg class="absolute left-6 top-1/2 transform -translate-y-1/2 text-gray-400 w-6 h-6"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" id="textsearch"
                                class="w-full pl-16 pr-6 py-6 text-xl bg-white/80 border-2 border-gray-200/50 rounded-2xl focus:outline-none focus:border-blue-500 focus:bg-white transition-all duration-300 placeholder-gray-500"
                                placeholder="Ketikkan kata kunci, nomor peraturan, atau topik yang dicari...">
                        </div>
                    </div>

                    <!-- Filter Options -->
                    <div class="grid md:grid-cols-3 gap-6 mb-8">
                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700">Jenis Dokumen</label>
                            <div class="relative">
                                <select id="tipe"
                                    class="w-full px-6 py-4 bg-white/80 border-2 border-gray-200/50 rounded-2xl focus:outline-none focus:border-blue-500 focus:bg-white transition-all duration-300 text-gray-700 font-medium appearance-none">
                                    <option value="">Semua Jenis Dokumen</option>
                                    <option value="perda">📜 PERDA</option>
                                    <option value="perwal">📋 PERWAL</option>
                                    <option value="keputusan-wali-kota">✅ KEPUTUSAN WALI KOTA</option>
                                    <option value="propemperda">📊 PROPEMPERDA</option>
                                </select>
                                <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5 pointer-events-none"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700">Status Dokumen</label>
                            <div class="relative">
                                <select id="status"
                                    class="w-full px-6 py-4 bg-white/80 border-2 border-gray-200/50 rounded-2xl focus:outline-none focus:border-blue-500 focus:bg-white transition-all duration-300 text-gray-700 font-medium appearance-none">
                                    <option value="">Semua Status</option>
                                    <option value="berlaku">✅ Berlaku</option>
                                    <option value="tidak-berlaku">❌ Tidak Berlaku</option>
                                </select>
                                <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5 pointer-events-none"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="text-sm font-semibold text-gray-700">Tahun Terbit</label>
                            <div class="relative">
                                <select id="tahun"
                                    class="w-full px-6 py-4 bg-white/80 border-2 border-gray-200/50 rounded-2xl focus:outline-none focus:border-blue-500 focus:bg-white transition-all duration-300 text-gray-700 font-medium appearance-none">
                                    <option value="ALL">Semua Tahun</option>
                                    @if(isset($mintahun) && isset($maxtahun))
                                        @for ($i = $maxtahun; $i >= $mintahun; $i--)
                                            <option value="{{ $i }}">🗓️ {{ $i }}</option>
                                        @endfor
                                    @endif
                                </select>
                                <svg class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 w-5 h-5 pointer-events-none"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="text-center">
                        <button id="btnsearch"
                            class="group bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 hover:from-blue-700 hover:via-purple-700 hover:to-indigo-700 text-white px-12 py-5 rounded-2xl font-bold text-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl flex items-center mx-auto">
                            <svg class="w-6 h-6 mr-3 group-hover:scale-110 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <span>Cari Sekarang</span>
                            <div
                                class="ml-3 bg-white/20 rounded-full p-2 group-hover:bg-white/30 transition-all duration-300">
                                <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </button>
                    </div>

                    <!-- Quick Search Suggestions -->
                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-600 mb-4 font-medium">Pencarian Populer:</p>
                        <div class="flex flex-wrap gap-3 justify-center">
                            <button onclick="applyQuickSearch('perda', '', 'berlaku')"
                                class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-medium hover:bg-blue-200 transition-colors cursor-pointer hover:scale-105 transform transition-all duration-200">
                                📜 Perda Terbaru
                            </button>
                            <button onclick="applyQuickSearch('perwal', '', 'ALL', '2024')"
                                class="bg-purple-100 text-purple-700 px-4 py-2 rounded-full text-sm font-medium hover:bg-purple-200 transition-colors cursor-pointer hover:scale-105 transform transition-all duration-200">
                                📋 Perwal 2024
                            </button>
                            <button onclick="applyQuickSearch('keputusan-wali-kota', '', 'berlaku')"
                                class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-medium hover:bg-green-200 transition-colors cursor-pointer hover:scale-105 transform transition-all duration-200">
                                ✅ Keputusan Aktif
                            </button>
                            <button onclick="applyQuickSearch('', 'APBD', 'ALL')"
                                class="bg-orange-100 text-orange-700 px-4 py-2 rounded-full text-sm font-medium hover:bg-orange-200 transition-colors cursor-pointer hover:scale-105 transform transition-all duration-200">
                                🏢 APBD
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Browse by Theme Section -->
    <section class="bg-gradient-to-br from-gray-50 to-slate-100 py-24">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-16">
                <div
                    class="inline-flex items-center bg-blue-100 text-blue-700 rounded-full px-6 py-3 mb-6 font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                        </path>
                    </svg>
                    Telusur Berdasarkan Kategori
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold mb-6">
                    <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Jelajahi
                        Tema Hukum</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Temukan dokumen hukum yang diorganisir berdasarkan tema dan kategori untuk navigasi dan penelitian
                    yang lebih mudah
                </p>
            </div>

            <!-- Theme Cards Container -->
            <div class="max-w-7xl mx-auto">
                <div id="tema-dokumen-container"
                    class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    <!-- Loading State -->
                    <div class="col-span-full flex justify-center items-center py-12">
                        <div class="flex flex-col items-center space-y-4">
                            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
                            <p class="text-gray-600 font-medium">Loading themes...</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call-to-Action -->
            <div class="text-center mt-16">
                <div class="bg-white rounded-2xl p-8 shadow-xl max-w-2xl mx-auto border border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Tidak menemukan yang Anda cari?</h3>
                    <p class="text-gray-600 mb-6">Gunakan fitur pencarian canggih kami untuk menemukan dokumen dan
                        peraturan spesifik</p>
                    <a href="#"
                        onclick="document.getElementById('textsearch').focus(); document.getElementById('textsearch').scrollIntoView({behavior: 'smooth'})"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Pencarian Canggih
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Legal Products Showcase -->
    <section class="bg-white py-24">
        <div class="container mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-16">
                <div
                    class="inline-flex items-center bg-green-100 text-green-700 rounded-full px-6 py-3 mb-6 font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Dokumen Hukum
                </div>
                <h2 class="text-4xl lg:text-5xl font-bold mb-6">
                    <span class="bg-gradient-to-r from-green-600 to-blue-600 bg-clip-text text-transparent">Dokumen
                        Terbaru & Populer</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Tetap update dengan dokumen hukum terbaru dan temukan peraturan yang paling banyak dicari
                </p>
            </div>

            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12">
                    <!-- Latest Legal Documents -->
                    <div class="group">
                        <div
                            class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-1 shadow-xl hover:shadow-2xl transition-all duration-300">
                            <div class="bg-white rounded-2xl p-8 h-full">
                                <!-- Header -->
                                <div class="flex items-center justify-between mb-8">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-gradient-to-r from-blue-500 to-blue-600 p-3 rounded-xl">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-2xl font-bold text-gray-900">Dokumen Terbaru</h3>
                                    </div>
                                    <div class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold">
                                        {{ count($regulasi) }} Baru
                                    </div>
                                </div>

                                <!-- Documents List -->
                                <div
                                    class="space-y-4 max-h-[500px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-gray-300">
                                    @foreach ($regulasi as $index => $r)
                                        <div
                                            class="group/item bg-gradient-to-r from-gray-50 to-blue-50 hover:from-blue-50 hover:to-indigo-50 rounded-xl p-6 transition-all duration-300 hover:shadow-lg border border-gray-100 hover:border-blue-200">
                                            <a href="/produk-hukum/{{ $r->nama_singkat }}/{{ $r->id }}/{{ Str::slug($r->judul) }}"
                                                class="block">
                                                <!-- Header Row -->
                                                <div class="flex items-start justify-between mb-3">
                                                    <div class="flex items-center space-x-2">
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-600 to-purple-600 text-white">
                                                            {{ $r->nama_singkat }}
                                                        </span>
                                                        <span
                                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                                            #{{ $index + 1 }}
                                                        </span>
                                                    </div>
                                                    <span class="text-xs text-gray-500 bg-white px-2 py-1 rounded-full">
                                                        {{ $r->tanggal_diundangkan ? date('d M Y', strtotime($r->tanggal_diundangkan)) : '' }}
                                                    </span>
                                                </div>

                                                <!-- Title -->
                                                <h4
                                                    class="font-bold text-gray-900 mb-2 group-hover/item:text-blue-600 transition-colors">
                                                    {{ $r->nama_singkat }} No. {{ $r->nomor }} Tahun {{ $r->tahun }}
                                                </h4>

                                                <!-- Content -->
                                                <p class="text-gray-600 text-sm line-clamp-2 mb-3">{{ $r->judul }}</p>

                                                <!-- Footer -->
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-2 text-xs text-gray-500">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z">
                                                            </path>
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                            </path>
                                                        </svg>
                                                        <span>Click to view</span>
                                                    </div>
                                                    <svg class="w-4 h-4 text-blue-500 group-hover/item:translate-x-1 transition-transform"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Most Popular Documents -->
                    <div class="group">
                        <div
                            class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-2xl p-1 shadow-xl hover:shadow-2xl transition-all duration-300">
                            <div class="bg-white rounded-2xl p-8 h-full">
                                <!-- Header -->
                                <div class="flex items-center justify-between mb-8">
                                    <div class="flex items-center space-x-3">
                                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 p-3 rounded-xl">
                                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                                            </svg>
                                        </div>
                                        <h3 class="text-2xl font-bold text-gray-900">Paling Populer</h3>
                                    </div>
                                    <div
                                        class="bg-purple-100 text-purple-600 px-4 py-2 rounded-full text-sm font-semibold">
                                        Trending
                                    </div>
                                </div>

                                <!-- Documents List -->
                                <div
                                    class="space-y-4 max-h-[500px] overflow-y-auto pr-2 scrollbar-thin scrollbar-thumb-gray-300">
                                    @foreach ($popular_item as $index => $p)
                                        <div
                                            class="group/item bg-gradient-to-r from-gray-50 to-purple-50 hover:from-purple-50 hover:to-pink-50 rounded-xl p-6 transition-all duration-300 hover:shadow-lg border border-gray-100 hover:border-purple-200">
                                            <a href="/produk-hukum/{{ $p->kategori->nama_singkat }}/{{ $p->regulasi->id }}/{{ Str::slug($p->regulasi->judul) }}"
                                                class="block">
                                                <!-- Header Row -->
                                                <div class="flex items-start justify-between mb-3">
                                                    <div class="flex items-center space-x-2">
                                                        <span
                                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-purple-600 to-pink-600 text-white">
                                                            {{ $p->kategori->nama_singkat }}
                                                        </span>
                                                        <span
                                                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-orange-100 text-orange-700">
                                                            #{{ $index + 1 }}
                                                        </span>
                                                    </div>
                                                    <span class="text-xs text-gray-500 bg-white px-2 py-1 rounded-full">
                                                        {{ $p->regulasi->tanggal_diundangkan ? date('d M Y', strtotime($p->regulasi->tanggal_diundangkan)) : '' }}
                                                    </span>
                                                </div>

                                                <!-- Title -->
                                                <h4
                                                    class="font-bold text-gray-900 mb-2 group-hover/item:text-purple-600 transition-colors">
                                                    {{ $p->kategori->nama_singkat }} No. {{ $p->regulasi->nomor }} Tahun
                                                    {{ $p->regulasi->tahun }}
                                                </h4>

                                                <!-- Content -->
                                                <p class="text-gray-600 text-sm line-clamp-2 mb-3">{{ $p->regulasi->judul }}
                                                </p>

                                                <!-- Footer -->
                                                <div class="flex items-center justify-between">
                                                    <div class="flex items-center space-x-4 text-xs">
                                                        <div class="flex items-center space-x-1 text-purple-600">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                                                                </path>
                                                            </svg>
                                                            <span>Popular</span>
                                                        </div>
                                                    </div>
                                                    <svg class="w-4 h-4 text-purple-500 group-hover/item:translate-x-1 transition-transform"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- View All CTA -->
                <div class="text-center mt-16">
                    <div
                        class="bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-8 max-w-3xl mx-auto border border-gray-200">
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Jelajahi Lebih Banyak Dokumen Hukum</h3>
                        <p class="text-gray-600 mb-6">Akses database lengkap dokumen hukum dan peraturan kami</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="/perda"
                                class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-xl hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                                    </path>
                                </svg>
                                Jelajahi Semua Dokumen
                            </a>
                            <a href="#"
                                onclick="document.getElementById('textsearch').focus(); document.getElementById('textsearch').scrollIntoView({behavior: 'smooth'})"
                                class="inline-flex items-center px-6 py-3 bg-white text-gray-700 font-semibold rounded-xl border-2 border-gray-300 hover:border-gray-400 hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Pencarian Canggih
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(isset($slide) && count($slide) > 0)
        <!-- Hero Slider Section -->
        <section class="relative overflow-hidden">
            <div class="hero-slider relative h-96 lg:h-[500px]">
                <div class="slides-container relative w-full h-full">
                    @foreach($slide as $index => $item)
                        <div class="slide absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                            data-slide="{{ $index }}">
                            @if($item->foto)
                                <div class="absolute inset-0">
                                    <img src="{{ asset($item->foto) }}" alt="{{ $item->judul ?? 'Slide' }}"
                                        class="w-full h-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-black/25"></div>
                                </div>
                            @else
                                <div class="absolute inset-0 bg-gradient-to-r from-blue-900 to-blue-700"></div>
                            @endif

                            @if($item->judul || $item->subjudul)
                                <div class="relative z-10 flex items-center h-full">
                                    <div class="container mx-auto px-4">
                                        <div class="max-w-4xl text-white">
                                            @if($item->judul)
                                                <h2 class="text-3xl lg:text-5xl font-bold mb-6 leading-tight">{{ $item->judul }}</h2>
                                            @endif
                                            @if($item->subjudul)
                                                <p class="text-lg lg:text-xl opacity-90">{{ $item->subjudul }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Navigation Arrows -->
                @if(count($slide) > 1)
                    <button
                        class="slider-prev absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300 z-20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                    </button>
                    <button
                        class="slider-next absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300 z-20">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </button>

                    <!-- Pagination Dots -->
                    <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex space-x-2 z-20">
                        @foreach($slide as $index => $item)
                            <button
                                class="pagination-dot w-3 h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white' : 'bg-white/50 hover:bg-white/80' }}"
                                data-slide="{{ $index }}"></button>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>
    @else
        <!-- Fallback Hero Section -->
        <section class="relative min-h-screen flex items-center justify-center overflow-hidden">
            <!-- Animated Background -->
            <div class="absolute inset-0 bg-gradient-to-br from-blue-900 via-purple-900 to-slate-900">
                <div
                    class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,_rgba(59,_130,_246,_0.1)_0%,_transparent_50%)] animate-pulse">
                </div>
                <div class="absolute top-10 left-10 w-72 h-72 bg-blue-500/10 rounded-full blur-3xl animate-bounce"></div>
                <div class="absolute bottom-10 right-10 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl animate-pulse">
                </div>
                <div
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-r from-blue-500/5 to-purple-500/5 rounded-full blur-3xl">
                </div>
            </div>

            <div class="relative z-10 container mx-auto px-4 text-center">
                <!-- Badge -->
                <div
                    class="inline-flex items-center bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-8 border border-white/20">
                    <span class="text-blue-300 text-sm font-semibold">🏦 Pemerintah Kota Banjarbaru</span>
                </div>

                <!-- Main Title -->
                <h1 class="text-5xl lg:text-7xl font-bold mb-8 leading-tight">
                    <span class="text-white">Jaringan Dokumentasi dan</span><br>
                    <span
                        class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent animate-pulse">Informasi
                        Hukum</span><br>
                    <span class="text-white">Kota Banjarbaru</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl lg:text-2xl text-gray-300 mb-12 max-w-4xl mx-auto leading-relaxed">
                    Platform digital terdepan untuk mengakses produk hukum, informasi peraturan, dan layanan konsultasi
                    hukum
                    <span class="text-blue-400 font-semibold">Pemerintah Kota Banjarbaru</span>
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-6 justify-center items-center">
                    <a href="#produk-hukum"
                        class="group bg-gradient-to-r from-blue-600 to-purple-600 text-white px-10 py-5 rounded-2xl font-bold text-lg hover:shadow-2xl transform hover:scale-105 transition-all duration-300 flex items-center space-x-3">
                        <span>📄 Jelajahi Produk Hukum</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    <a href="#statistik"
                        class="group bg-white/10 backdrop-blur-sm border-2 border-white/30 text-white px-10 py-5 rounded-2xl font-bold text-lg hover:bg-white hover:text-blue-600 transition-all duration-300 flex items-center space-x-3">
                        <span>📊 Lihat Statistik</span>
                        <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Stats Preview -->
                <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8 max-w-4xl mx-auto">
                    @if(isset($totalperda))
                        <div class="text-center">
                            <div class="text-3xl lg:text-4xl font-bold text-blue-400 mb-2">{{ number_format($totalperda) }}
                            </div>
                            <div class="text-gray-400 text-sm font-medium">Peraturan Daerah</div>
                        </div>
                    @endif
                    @if(isset($totalperwal))
                        <div class="text-center">
                            <div class="text-3xl lg:text-4xl font-bold text-purple-400 mb-2">{{ number_format($totalperwal) }}
                            </div>
                            <div class="text-gray-400 text-sm font-medium">Peraturan Walikota</div>
                        </div>
                    @endif
                    @if(isset($totalkepwal))
                        <div class="text-center">
                            <div class="text-3xl lg:text-4xl font-bold text-pink-400 mb-2">{{ number_format($totalkepwal) }}
                            </div>
                            <div class="text-gray-400 text-sm font-medium">Keputusan Walikota</div>
                        </div>
                    @endif
                    @if(isset($totalpropemperda))
                        <div class="text-center">
                            <div class="text-3xl lg:text-4xl font-bold text-indigo-400 mb-2">
                                {{ number_format($totalpropemperda) }}
                            </div>
                            <div class="text-gray-400 text-sm font-medium">Propemperda</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
                <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                    </path>
                </svg>
                <p class="text-sm text-gray-400">Scroll untuk melihat lebih banyak</p>
            </div>
        </section>
    @endif

    <!-- Statistics Dashboard -->
    <section id="statistik"
        class="relative py-24 bg-gradient-to-br from-gray-900 via-blue-900 to-purple-900 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-10 w-64 h-64 bg-blue-500/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-80 h-80 bg-purple-500/10 rounded-full blur-3xl animate-bounce">
            </div>
            <div
                class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-indigo-500/5 rounded-full blur-3xl">
            </div>
        </div>

        <div class="relative z-10 container mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-20">
                <div
                    class="inline-flex items-center bg-white/10 backdrop-blur-sm rounded-full px-6 py-3 mb-8 border border-white/20">
                    <span class="text-blue-300 text-sm font-semibold">📊 Data Analytics</span>
                </div>
                <h2 class="text-5xl lg:text-6xl font-bold mb-6">
                    <span
                        class="bg-gradient-to-r from-blue-400 via-purple-400 to-pink-400 bg-clip-text text-transparent">Statistik
                        Produk Hukum</span>
                </h2>
                <p class="text-xl text-gray-300 max-w-3xl mx-auto leading-relaxed">
                    Dashboard analitik real-time untuk memantau perkembangan dan distribusi produk hukum Kota Banjarbaru
                </p>
            </div>

            <!-- Main Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-20">
                @if(isset($totalperda))
                    <div
                        class="group relative bg-white/10 backdrop-blur-xl rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:scale-105">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-blue-500/20 to-blue-600/20 rounded-3xl blur opacity-75 group-hover:opacity-100 transition-opacity">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="bg-blue-500/20 rounded-2xl p-4 w-fit mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-4xl lg:text-5xl font-bold text-white mb-3 stats-counter">
                                {{ number_format($totalperda) }}
                            </h3>
                            <p class="text-blue-200 font-semibold mb-2">Peraturan Daerah</p>
                            @php
                                $currentYear = date('Y');
                                $perdaThisYear = isset($tahunanperda[$currentYear]) ? $tahunanperda[$currentYear] : 0;
                            @endphp
                            @if($perdaThisYear > 0)
                                <div class="bg-white/10 rounded-full px-3 py-1 w-fit">
                                    <p class="text-xs text-blue-200">
                                        +{{ $perdaThisYear }} di tahun ini</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                @if(isset($totalperwal))
                    <div
                        class="group relative bg-white/10 backdrop-blur-xl rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:scale-105">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-green-500/20 to-green-600/20 rounded-3xl blur opacity-75 group-hover:opacity-100 transition-opacity">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="bg-green-500/20 rounded-2xl p-4 w-fit mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-green-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-4xl lg:text-5xl font-bold text-white mb-3 stats-counter">
                                {{ number_format($totalperwal) }}
                            </h3>
                            <p class="text-green-200 font-semibold mb-2">Peraturan Walikota</p>
                            @php
                                $currentYear = date('Y');
                                $perwalThisYear = isset($tahunanperwal[$currentYear]) ? $tahunanperwal[$currentYear] : 0;
                            @endphp
                            @if($perwalThisYear > 0)
                                <div class="bg-white/10 rounded-full px-3 py-1 w-fit">
                                    <p class="text-xs text-green-200">
                                        +{{ $perwalThisYear }} di tahun ini</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                @if(isset($totalkepwal))
                    <div
                        class="group relative bg-white/10 backdrop-blur-xl rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:scale-105">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-purple-500/20 to-purple-600/20 rounded-3xl blur opacity-75 group-hover:opacity-100 transition-opacity">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="bg-purple-500/20 rounded-2xl p-4 w-fit mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-4xl lg:text-5xl font-bold text-white mb-3 stats-counter">
                                {{ number_format($totalkepwal) }}
                            </h3>
                            <p class="text-purple-200 font-semibold mb-2">Keputusan Walikota</p>
                            @php
                                $currentYear = date('Y');
                                $kepwalThisYear = isset($tahunankepwal[$currentYear]) ? $tahunankepwal[$currentYear] : 0;
                            @endphp
                            @if($kepwalThisYear > 0)
                                <div class="bg-white/10 rounded-full px-3 py-1 w-fit">
                                    <p class="text-xs text-purple-200">
                                        +{{ $kepwalThisYear }} di tahun ini</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                @if(isset($totalpropemperda))
                    <div
                        class="group relative bg-white/10 backdrop-blur-xl rounded-3xl p-8 border border-white/20 hover:bg-white/20 transition-all duration-500 hover:scale-105">
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-orange-500/20 to-orange-600/20 rounded-3xl blur opacity-75 group-hover:opacity-100 transition-opacity">
                        </div>
                        <div class="relative z-10">
                            <div
                                class="bg-orange-500/20 rounded-2xl p-4 w-fit mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg class="w-8 h-8 text-orange-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-4xl lg:text-5xl font-bold text-white mb-3 stats-counter">
                                {{ number_format($totalpropemperda) }}
                            </h3>
                            <p class="text-orange-200 font-semibold mb-2">Propemperda</p>
                            @php
                                $currentYear = date('Y');
                                $propemperdaThisYear = isset($tahunanpropemperda[$currentYear]) ? $tahunanpropemperda[$currentYear] : 0;
                            @endphp
                            @if($propemperdaThisYear > 0)
                                <div class="bg-white/10 rounded-full px-3 py-1 w-fit">
                                    <p class="text-xs text-orange-200">
                                        +{{ $propemperdaThisYear }} di tahun ini</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Yearly Legal Products Chart -->
            @php
                // Combine all yearly data
                $yearlyData = [];

                // Get all years from all categories
                $allYears = [];
                if (isset($tahunanperda))
                    $allYears = array_merge($allYears, array_keys($tahunanperda));
                if (isset($tahunanperwal))
                    $allYears = array_merge($allYears, array_keys($tahunanperwal));
                if (isset($tahunankepwal))
                    $allYears = array_merge($allYears, array_keys($tahunankepwal));
                if (isset($tahunanpropemperda))
                    $allYears = array_merge($allYears, array_keys($tahunanpropemperda));
                $allYears = array_unique($allYears);
                sort($allYears);

                // Build data for each year
                foreach ($allYears as $year) {
                    $yearlyData[$year] = [
                        'perda' => isset($tahunanperda[$year]) ? $tahunanperda[$year] : 0,
                        'perwal' => isset($tahunanperwal[$year]) ? $tahunanperwal[$year] : 0,
                        'kepwal' => isset($tahunankepwal[$year]) ? $tahunankepwal[$year] : 0,
                        'propemperda' => isset($tahunanpropemperda[$year]) ? $tahunanpropemperda[$year] : 0,
                        'total' => (isset($tahunanperda[$year]) ? $tahunanperda[$year] : 0) +
                            (isset($tahunanperwal[$year]) ? $tahunanperwal[$year] : 0) +
                            (isset($tahunankepwal[$year]) ? $tahunankepwal[$year] : 0) +
                            (isset($tahunanpropemperda[$year]) ? $tahunanpropemperda[$year] : 0)
                    ];
                }

                // Get last 10 years for display
                $displayYears = array_slice($allYears, -10);
            @endphp

            @if(count($yearlyData) > 0)
                <div class="mb-8">
                    <div class="bg-white rounded-2xl shadow-xl p-6">
                        <h3 class="text-xl font-bold mb-6 text-gray-900">Tren Produk Hukum Per Tahun</h3>

                        @php
                            $maxValue = 0;
                            foreach ($displayYears as $year) {
                                if (isset($yearlyData[$year]) && $yearlyData[$year]['total'] > $maxValue) {
                                    $maxValue = $yearlyData[$year]['total'];
                                }
                            }
                            $maxValue = ceil($maxValue / 10) * 10; // Round up to nearest 10
                            if ($maxValue == 0)
                                $maxValue = 10;
                        @endphp

                        <!-- Simple Bar Chart -->
                        <div class="relative">
                            <!-- Y-axis Scale -->
                            <div
                                class="absolute left-0 top-0 bottom-8 w-12 flex flex-col justify-between text-xs text-gray-600 text-right pr-2">
                                @for($i = 5; $i >= 0; $i--)
                                    <span>{{ round($maxValue * $i / 5) }}</span>
                                @endfor
                            </div>

                            <!-- Chart Area -->
                            <div class="ml-14 relative" style="height: 300px;">
                                <!-- Grid Lines -->
                                <div class="absolute inset-0">
                                    @for($i = 0; $i <= 5; $i++)
                                        <div class="absolute w-full border-b border-gray-200" style="top: {{ $i * 20 }}%"></div>
                                    @endfor
                                </div>

                                <!-- Bars -->
                                <div class="relative h-full flex items-end gap-2 px-2" style="z-index: 10;">
                                    @foreach($displayYears as $year)
                                        @php
                                            $value = isset($yearlyData[$year]) ? $yearlyData[$year]['total'] : 0;
                                            $heightPercent = $maxValue > 0 ? ($value / $maxValue * 100) : 0;
                                            $perda = isset($yearlyData[$year]) ? $yearlyData[$year]['perda'] : 0;
                                            $perwal = isset($yearlyData[$year]) ? $yearlyData[$year]['perwal'] : 0;
                                            $kepwal = isset($yearlyData[$year]) ? $yearlyData[$year]['kepwal'] : 0;
                                            $propemperda = isset($yearlyData[$year]) ? $yearlyData[$year]['propemperda'] : 0;
                                        @endphp

                                        <div class="flex-1 group relative flex flex-col items-center justify-end h-full">
                                            <!-- Tooltip (keeping the enhanced version but moving it after the bar) -->
                                            <div
                                                class="absolute bottom-full mb-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 pointer-events-none">
                                                <div
                                                    class="bg-gray-900 text-white text-xs rounded-lg py-2 px-3 shadow-xl whitespace-nowrap">
                                                    <div class="font-bold mb-1">Tahun {{ $year }}</div>
                                                    @if($perda > 0)
                                                        <div class="flex justify-between gap-4"><span>Perda:</span> <span
                                                    class="font-bold">{{ $perda }}</span></div>@endif
                                                    @if($perwal > 0)
                                                        <div class="flex justify-between gap-4"><span>Perwal:</span> <span
                                                    class="font-bold">{{ $perwal }}</span></div>@endif
                                                    @if($kepwal > 0)
                                                        <div class="flex justify-between gap-4"><span>Kepwal:</span> <span
                                                    class="font-bold">{{ $kepwal }}</span></div>@endif
                                                    @if($propemperda > 0)
                                                        <div class="flex justify-between gap-4"><span>Propemperda:</span> <span
                                                    class="font-bold">{{ $propemperda }}</span></div>@endif
                                                    <div class="font-bold mt-1 pt-1 border-t border-gray-700">Total:
                                                        {{ $value }}
                                                    </div>
                                                    <div
                                                        class="absolute bottom-0 left-1/2 transform -translate-x-1/2 translate-y-full">
                                                        <div class="border-4 border-transparent border-t-gray-900"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Simple Stacked Bar -->
                                            @if($value > 0)
                                                <div class="w-full bg-gradient-to-t from-blue-500 to-blue-400 rounded-t hover:from-blue-400 hover:to-blue-300 transition-all duration-300 group-hover:scale-105 relative overflow-hidden"
                                                    style="height: {{ $heightPercent }}%; max-width: 50px; min-height: 5px;">

                                                    @php
                                                        $currentBottom = 0;
                                                    @endphp

                                                    <!-- Stacked segments using divs with background colors -->
                                                    @if($perda > 0)
                                                        @php $perdaHeight = ($perda / $value) * 100; @endphp
                                                        <div class="absolute inset-x-0 bg-blue-500"
                                                            style="bottom: {{ $currentBottom }}%; height: {{ $perdaHeight }}%;"></div>
                                                        @php $currentBottom += $perdaHeight; @endphp
                                                    @endif

                                                    @if($perwal > 0)
                                                        @php $perwalHeight = ($perwal / $value) * 100; @endphp
                                                        <div class="absolute inset-x-0 bg-green-500"
                                                            style="bottom: {{ $currentBottom }}%; height: {{ $perwalHeight }}%;"></div>
                                                        @php $currentBottom += $perwalHeight; @endphp
                                                    @endif

                                                    @if($kepwal > 0)
                                                        @php $kepwalHeight = ($kepwal / $value) * 100; @endphp
                                                        <div class="absolute inset-x-0 bg-purple-500"
                                                            style="bottom: {{ $currentBottom }}%; height: {{ $kepwalHeight }}%;"></div>
                                                        @php $currentBottom += $kepwalHeight; @endphp
                                                    @endif

                                                    @if($propemperda > 0)
                                                        @php $propemperdaHeight = ($propemperda / $value) * 100; @endphp
                                                        <div class="absolute inset-x-0 bg-orange-500"
                                                            style="bottom: {{ $currentBottom }}%; height: {{ $propemperdaHeight }}%;">
                                                        </div>
                                                    @endif

                                                    <!-- Hover overlay -->
                                                    <div
                                                        class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity duration-300">
                                                    </div>
                                                </div>
                                            @else
                                                <div class="w-full bg-gray-300" style="height: 2px; max-width: 50px;"></div>
                                            @endif

                                            <!-- Year label -->
                                            <span class="text-xs text-gray-600 font-medium mt-2">{{ $year }}</span>

                                            <!-- Value label -->
                                            <span class="text-xs font-bold text-gray-800">{{ $value }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Legend -->
                        <div class="flex flex-wrap justify-center gap-4 mt-6 pt-4 border-t border-gray-200">
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 bg-blue-500 rounded"></div>
                                <span class="text-xs text-gray-600">Peraturan Daerah</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 bg-green-500 rounded"></div>
                                <span class="text-xs text-gray-600">Peraturan Walikota</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 bg-purple-500 rounded"></div>
                                <span class="text-xs text-gray-600">Keputusan Walikota</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 bg-orange-500 rounded"></div>
                                <span class="text-xs text-gray-600">Propemperda</span>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Charts Section -->
            <div class="grid lg:grid-cols-3 gap-8">
                @php
                    $palingDiunduhData = isset($palingDiunduh) ? json_decode($palingDiunduh, true) : null;
                @endphp
                @if($palingDiunduhData && is_array($palingDiunduhData) && count($palingDiunduhData) > 0)
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-xl font-semibold mb-4 text-gray-900">Paling Diunduh</h3>
                        <div class="space-y-3">
                            @foreach(array_slice($palingDiunduhData, 0, 5) as $index => $item)
                                <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <span
                                            class="bg-blue-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold">
                                            {{ $index + 1 }}
                                        </span>
                                        <span class="text-gray-800 text-sm flex-1">{{ $item['label'] ?? 'Dokumen' }}</span>
                                    </div>
                                    <span
                                        class="text-blue-600 font-semibold text-lg">{{ number_format($item['value'] ?? 0) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @php
                    $palingDicariData = isset($palingDicari) ? json_decode($palingDicari, true) : null;
                @endphp
                @if($palingDicariData && is_array($palingDicariData) && count($palingDicariData) > 0)
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-xl font-semibold mb-4 text-gray-900">Paling Dicari</h3>
                        <div class="space-y-3">
                            @foreach(array_slice($palingDicariData, 0, 5) as $index => $item)
                                <div class="flex items-center justify-between p-3 bg-white rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <span
                                            class="bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold">
                                            {{ $index + 1 }}
                                        </span>
                                        <span class="text-gray-800 text-sm flex-1">{{ $item['label'] ?? 'Dokumen' }}</span>
                                    </div>
                                    <span
                                        class="text-green-600 font-semibold text-lg">{{ number_format($item['value'] ?? 0) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(isset($berlakudantidak))
                    <div class="bg-gray-50 rounded-xl p-6">
                        <h3 class="text-xl font-semibold mb-4 text-gray-900">Status Dokumen</h3>
                        <div class="space-y-4">
                            @if(isset($berlakudantidak->berlaku))
                                <div class="flex items-center justify-between p-4 bg-green-100 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <span
                                            class="bg-green-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold">1</span>
                                        <span class="text-gray-800 font-medium">Berlaku</span>
                                    </div>
                                    <span
                                        class="text-green-700 font-bold text-lg">{{ number_format($berlakudantidak->berlaku) }}</span>
                                </div>
                            @endif
                            @if(isset($berlakudantidak->tidak_berkalu))
                                <div class="flex items-center justify-between p-4 bg-red-100 rounded-lg">
                                    <div class="flex items-center space-x-3">
                                        <span
                                            class="bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold">2</span>
                                        <span class="text-gray-800 font-medium">Tidak Berlaku</span>
                                    </div>
                                    <span
                                        class="text-red-700 font-bold text-lg">{{ number_format($berlakudantidak->tidak_berkalu) }}</span>
                                </div>
                            @endif
                        </div>
                        @if(isset($mintahun) && isset($maxtahun))
                            <p class="text-xs text-gray-500 mt-4">Data periode {{ $mintahun }} - {{ $maxtahun }}</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if(isset($popular_item) && is_array($popular_item) && count($popular_item) > 0)
        <!-- Popular Products Section -->
        <section id="produk-hukum" class="bg-gray-100 py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl lg:text-4xl font-bold text-center mb-12 text-gray-900">Produk Hukum Populer</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($popular_item as $item)
                        <div class="card-hover bg-white rounded-xl shadow-lg p-6">
                            <div class="flex items-start justify-between mb-4">
                                <div class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ $item->type ?? $item->category ?? 'Dokumen' }}
                                </div>
                                @if(isset($item->year))
                                    <span class="text-gray-500 text-sm">{{ $item->year }}</span>
                                @endif
                            </div>
                            <h3 class="text-lg font-semibold mb-3 text-gray-900 line-clamp-2">
                                {{ $item->title ?? $item->name ?? 'Produk Hukum' }}
                            </h3>
                            @if(isset($item->number))
                                <p class="text-sm text-gray-600 mb-3">Nomor: {{ $item->number }}</p>
                            @endif
                            <div class="flex items-center justify-between">
                                @if(isset($item->downloads))
                                    <span class="text-xs text-gray-500">{{ $item->downloads }} unduhan</span>
                                @endif
                                <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                    Lihat Detail →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(isset($kegiatan) && is_array($kegiatan) && count($kegiatan) > 0)
        <!-- Activities Section -->
        <section id="kegiatan" class="bg-white py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl lg:text-4xl font-bold text-center mb-12 text-gray-900">Kegiatan Pemerintah</h2>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($kegiatan as $item)
                        <div class="card-hover bg-white rounded-xl shadow-lg overflow-hidden">
                            @if(isset($item->image))
                                <img src="{{ $item->image }}" alt="{{ $item->title ?? 'Kegiatan' }}"
                                    class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6">
                                @if(isset($item->date))
                                    <div
                                        class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-sm font-medium mb-3 inline-block">
                                        {{ date('d F Y', strtotime($item->date)) }}
                                    </div>
                                @endif
                                <h3 class="text-lg font-semibold mb-3 text-gray-900">
                                    {{ $item->title ?? $item->name ?? 'Kegiatan' }}
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-3">{{ $item->description ?? $item->content ?? '' }}
                                </p>
                                @if(isset($item->location))
                                    <p class="text-xs text-gray-500 mt-2">📍 {{ $item->location }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(isset($jadwal) && is_array($jadwal) && count($jadwal) > 0)
        <!-- Schedule Section -->
        <section class="bg-blue-50 py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-3xl lg:text-4xl font-bold text-center mb-12 text-gray-900">Jadwal Bagian Hukum</h2>
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-900">Tanggal</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-900">Kegiatan</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-900">Waktu</th>
                                        <th class="px-6 py-4 text-left text-sm font-medium text-gray-900">Lokasi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($jadwal as $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 text-sm text-gray-900">
                                                {{ isset($item->date) ? date('d/m/Y', strtotime($item->date)) : '-' }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                                                {{ $item->title ?? $item->activity ?? $item->name ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-600">
                                                {{ $item->time ?? $item->waktu ?? '-' }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-gray-600">
                                                {{ $item->location ?? $item->lokasi ?? '-' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Awards Section -->
    <section class="bg-white py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2
                    class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
                    Penghargaan</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Pencapaian dan pengakuan yang telah diraih dalam
                    memberikan pelayanan terbaik</p>
            </div>

            @if(isset($penghargaan) && count($penghargaan) > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                    @foreach($penghargaan as $award)
                        <div
                            class="bg-white rounded-xl p-4 shadow-lg hover:shadow-xl transition-all duration-300 text-center group border border-gray-100">
                            @php
                                $photos = is_string($award->foto) ? json_decode($award->foto, true) : $award->foto;
                                $firstPhoto = is_array($photos) && count($photos) > 0 ? $photos[0] : null;
                            @endphp

                            @if($firstPhoto)
                                <a href="{{ asset('storage/' . $firstPhoto) }}" target="_blank" class="block">
                                    <div class="w-full h-32 mb-3 overflow-hidden rounded-lg bg-gray-50">
                                        <img src="{{ asset('storage/' . $firstPhoto) }}" alt="{{ $award->nama }}"
                                            class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300"
                                            onerror="this.src='/assets/images/piagam.png'">
                                    </div>
                                </a>
                            @else
                                <div class="w-full h-32 mb-3 overflow-hidden rounded-lg bg-gray-50">
                                    <img src="/assets/images/piagam.png" alt="{{ $award->nama }}"
                                        class="w-full h-full object-contain">
                                </div>
                            @endif

                            <h3 class="text-sm font-semibold text-gray-800 line-clamp-2 mb-1">{{ $award->nama }}</h3>
                            @if($award->detail)
                                <p class="text-xs text-gray-500 line-clamp-2">{{ $award->detail }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Fallback when no awards -->
                <div class="text-center py-16">
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 rounded-3xl p-12 max-w-2xl mx-auto">
                        <div class="text-6xl mb-6">🏆</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Menuju Prestasi Lebih Baik</h3>
                        <p class="text-gray-600 text-lg">Kami terus berupaya memberikan pelayanan terbaik dan meraih
                            prestasi untuk kemajuan bersama</p>
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Social Media Section -->
    <section class="bg-gradient-to-br from-slate-50 to-blue-50 py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2
                    class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
                    Sosial Media</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Ikuti perkembangan terbaru dan berinteraksi dengan
                    kami melalui media sosial</p>
            </div>
            <div class="bg-white rounded-3xl shadow-xl p-8 max-w-4xl mx-auto">
                <div class="elfsight-app-f5c95a62-512f-4563-b43b-d4100a0f0240" data-elfsight-app-lazy></div>
            </div>
        </div>
    </section>

    <!-- Mobile App Banner -->
    <section class="bg-gradient-to-r from-indigo-600 via-purple-600 to-blue-600 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="inline-block bg-white bg-opacity-20 rounded-full px-4 py-2 mb-6">
                            <span class="text-sm font-semibold">📱 Mobile App</span>
                        </div>
                        <h1 class="text-4xl lg:text-5xl font-bold mb-6 leading-tight">Warga Banjarbaru, Ini <span
                                class="bg-gradient-to-r from-yellow-300 to-orange-300 bg-clip-text text-transparent">Idaman
                                Publik</span> Anda!</h1>
                        <p class="text-xl mb-8 opacity-90 leading-relaxed">Satu aplikasi dari <strong>JDIH Kota
                                Banjarbaru</strong> untuk akses layanan publik yang efisien dan transparan.</p>
                        <div class="flex flex-col sm:flex-row gap-4 items-start">
                            <a href="https://play.google.com/store/apps/details?id=go.id.banjarbarukota.idaman_publik&hl=id"
                                target="_blank" class="group">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Google_Play_Store_badge_EN.svg/2560px-Google_Play_Store_badge_EN.svg.png"
                                    alt="Get it on Google Play"
                                    class="h-16 group-hover:scale-105 transition-transform duration-300 drop-shadow-lg">
                            </a>
                        </div>
                    </div>
                    <div class="relative">
                        <div
                            class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-pink-400 rounded-3xl blur-3xl opacity-20 animate-pulse">
                        </div>
                        <div class="relative flex justify-center space-x-6">
                            <img src="https://play-lh.googleusercontent.com/L3EK240gC9UIWjdJp-s8BWSLpb47-Xv4egVeUigXfhe5jns0LkyTr5pBDRQh-SPDTko"
                                alt="App Screenshot 1"
                                class="rounded-3xl shadow-2xl w-36 lg:w-44 hover:scale-105 transition-transform duration-500 hover:rotate-3">
                            <img src="https://play-lh.googleusercontent.com/qJepK3idIyPuOnWAbXwLnNsl3RdZkSRc8Qfxn-bg2BP9Pk1UX3t9xPO8zM9OkcfFydY"
                                alt="App Screenshot 2"
                                class="rounded-3xl shadow-2xl w-36 lg:w-44 hover:scale-105 transition-transform duration-500 hover:-rotate-3 mt-8">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section - SaaS Style -->
    <section class="relative bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-24 overflow-hidden">
        <!-- Background Elements -->
        <div
            class="absolute top-0 left-0 w-64 h-64 bg-blue-200/30 rounded-full blur-3xl -translate-x-32 -translate-y-32">
        </div>
        <div
            class="absolute bottom-0 right-0 w-80 h-80 bg-purple-200/30 rounded-full blur-3xl translate-x-40 translate-y-40">
        </div>

        <div class="relative z-10 container mx-auto px-4">
            <!-- Header -->
            <div class="text-center mb-20">
                <div
                    class="inline-flex items-center bg-blue-100 text-blue-700 rounded-full px-6 py-3 mb-6 font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                        </path>
                    </svg>
                    Hubungi Kami
                </div>
                <h2 class="text-4xl lg:text-6xl font-bold mb-6">
                    <span
                        class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 bg-clip-text text-transparent">Hubungi
                        Tim Kami</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Punya pertanyaan tentang dokumen hukum atau butuh bantuan? Tim ahli kami siap membantu Anda
                    menavigasi informasi hukum
                </p>
            </div>

            <!-- Contact Cards -->
            <div class="grid lg:grid-cols-3 gap-8 mb-20">
                <!-- Quick Contact -->
                <div
                    class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300 group">
                    <div
                        class="bg-gradient-to-r from-blue-500 to-blue-600 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Telepon Kami</h3>
                    <p class="text-gray-600 mb-6">Bicara langsung dengan spesialis informasi hukum kami</p>
                    <a href="tel:+6251147772569"
                        class="inline-flex items-center text-blue-600 font-semibold hover:text-blue-700 transition-colors group-hover:translate-x-1">
                        <span class="text-lg">(0511) 4772569</span>
                        <svg class="w-4 h-4 ml-2 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <!-- Email Contact -->
                <div
                    class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300 group">
                    <div
                        class="bg-gradient-to-r from-green-500 to-emerald-600 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Email Kami</h3>
                    <p class="text-gray-600 mb-6">Kirim pertanyaan detail dan dapatkan respons yang komprehensif</p>
                    <a href="mailto:jdih@banjarbarukota.go.id"
                        class="inline-flex items-center text-green-600 font-semibold hover:text-green-700 transition-colors group-hover:translate-x-1">
                        <span>jdih@banjarbarukota.go.id</span>
                        <svg class="w-4 h-4 ml-2 transition-transform" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                            </path>
                        </svg>
                    </a>
                </div>

                <!-- Office Hours -->
                <div
                    class="bg-white/80 backdrop-blur-sm rounded-2xl p-8 shadow-xl border border-white/50 hover:shadow-2xl transition-all duration-300 group">
                    <div
                        class="bg-gradient-to-r from-purple-500 to-purple-600 w-16 h-16 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Jam Kerja</h3>
                    <p class="text-gray-600 mb-4">Kami tersedia selama jam kerja</p>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-700 font-medium">Senin - Jumat</span>
                            <span class="text-purple-600 font-semibold">07:30 - 15:30</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-700 font-medium">Akhir Pekan</span>
                            <span class="text-gray-500">Tutup</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Interactive Location & Contact Form -->
            <div class="grid lg:grid-cols-5 gap-12 max-w-7xl mx-auto">
                <!-- Location Info -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Address Card -->
                    <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-8 shadow-xl border border-white/50">
                        <div class="flex items-start space-x-4">
                            <div
                                class="bg-gradient-to-r from-red-500 to-pink-600 w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Kunjungi Kantor Kami</h3>
                                <p class="text-gray-700 font-medium mb-1">Jl. Panglima Batur No. 1</p>
                                <p class="text-gray-600">Banjarbaru, Kalimantan Selatan</p>
                                <a href="https://goo.gl/maps/YourLocationLink" target="_blank"
                                    class="inline-flex items-center text-red-600 font-semibold hover:text-red-700 transition-colors mt-3">
                                    <span>Buka di Maps</span>
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-6 border border-blue-200">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h3>
                        <div class="space-y-3">
                            <button onclick="document.getElementById('surveyPopup').classList.remove('hidden')"
                                class="w-full flex items-center justify-between p-3 bg-white rounded-xl hover:shadow-md transition-all duration-200 group">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-blue-100 p-2 rounded-lg">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 font-medium">Berikan Umpan Balik</span>
                                </div>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                            <a href="#"
                                onclick="document.getElementById('textsearch').focus(); document.getElementById('textsearch').scrollIntoView({behavior: 'smooth'})"
                                class="w-full flex items-center justify-between p-3 bg-white rounded-xl hover:shadow-md transition-all duration-200 group">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-green-100 p-2 rounded-lg">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 font-medium">Cari Dokumen</span>
                                </div>
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-green-600 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-3">
                    <div class="bg-white/90 backdrop-blur-sm rounded-2xl p-8 shadow-2xl border border-white/50">
                        <div class="text-center mb-8">
                            <h3 class="text-3xl font-bold mb-4">
                                <span
                                    class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">Kirim
                                    Pesan kepada Kami</span>
                            </h3>
                            <p class="text-gray-600">Isi formulir di bawah dan kami akan segera merespons Anda</p>
                        </div>

                        <form id="konsul" name="konsul" method="post" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap *</label>
                                    <input type="text" name="nama" id="nama" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 group-hover:border-blue-300 bg-gray-50 focus:bg-white">
                                </div>
                                <div class="group">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Email *</label>
                                    <input type="email" name="email" id="email" required
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 group-hover:border-blue-300 bg-gray-50 focus:bg-white">
                                </div>
                            </div>

                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Subjek *</label>
                                <input type="text" name="subjek" id="subjek" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 group-hover:border-blue-300 bg-gray-50 focus:bg-white">
                            </div>

                            <div class="group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Pesan *</label>
                                <textarea name="pesan" id="pesan" rows="5" required
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 resize-none group-hover:border-blue-300 bg-gray-50 focus:bg-white"></textarea>
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-4 px-8 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                <span>Kirim Pesan</span>
                            </button>

                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-sm text-blue-800 font-medium">Pesan Anda akan diteruskan melalui
                                        WhatsApp untuk respons yang lebih cepat</p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Google Maps Embed -->
            <div class="mt-20">
                <div class="text-center mb-8">
                    <h3 class="text-3xl font-bold text-gray-900 mb-4">Temukan Kami di Peta</h3>
                    <p class="text-gray-600">Berlokasi di jantung Kompleks Pemerintahan Kota Banjarbaru</p>
                </div>
                <div
                    class="rounded-3xl overflow-hidden shadow-2xl border border-gray-200 hover:shadow-3xl transition-shadow duration-300">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d995.6587315491789!2d114.83101809766961!3d-3.4386747501951818!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de6817491bf1bfd%3A0x598d17189e3fd73d!2sPemerintah%20Kota%20Banjarbaru%20Balaikota!5e0!3m2!1sid!2sid!4v1636334355960!5m2!1sid!2sid"
                        width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </section>

    <!-- Customer Satisfaction Index -->
    <section class="bg-gradient-to-br from-slate-900 via-purple-900 to-slate-900 text-white py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2
                    class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-blue-400 to-purple-400 bg-clip-text text-transparent mb-4">
                    Indeks Kepuasan Masyarakat</h2>
                <p class="text-xl text-gray-300 max-w-2xl mx-auto">Feedback dan penilaian masyarakat terhadap kualitas
                    pelayanan kami</p>
            </div>
            <div class="max-w-4xl mx-auto">
                @if(isset($skmData) && count($skmData) > 0)
                    <div class="bg-white bg-opacity-10 rounded-2xl p-8 backdrop-blur-sm">
                        <!-- Statistics Cards -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                            @php
                                $skmColors = [
                                    'Sangat Baik' => ['bg' => 'bg-green-500', 'text' => 'text-green-500'],
                                    'Baik' => ['bg' => 'bg-blue-500', 'text' => 'text-blue-500'],
                                    'Cukup Baik' => ['bg' => 'bg-yellow-500', 'text' => 'text-yellow-500'],
                                    'Kurang Baik' => ['bg' => 'bg-red-500', 'text' => 'text-red-500']
                                ];
                                $totalVotes = $skmData->sum('jumlah');
                            @endphp

                            @foreach(['Sangat Baik', 'Baik', 'Cukup Baik', 'Kurang Baik'] as $rating)
                                @php
                                    $item = $skmData->firstWhere('jawab', $rating);
                                    $count = $item ? $item->jumlah : 0;
                                    $percentage = $totalVotes > 0 ? round(($count / $totalVotes) * 100, 1) : 0;
                                    $color = $skmColors[$rating];
                                @endphp
                                <div class="bg-white bg-opacity-20 rounded-xl p-6 text-center backdrop-blur-sm">
                                    <div
                                        class="{{ $color['bg'] }} w-12 h-12 rounded-full mx-auto mb-4 flex items-center justify-center">
                                        <span class="text-white font-bold text-lg">{{ $percentage }}%</span>
                                    </div>
                                    <h3 class="text-2xl font-bold mb-2">{{ $count }}</h3>
                                    <p class="text-sm opacity-90">{{ $rating }}</p>
                                </div>
                            @endforeach
                        </div>

                        <!-- Visual Chart -->
                        <div class="bg-white bg-opacity-20 rounded-xl p-6 backdrop-blur-sm">
                            <div class="flex justify-center mb-4">
                                <div class="relative w-64 h-64">
                                    @php
                                        $startAngle = 0;
                                        $radius = 120;
                                        $centerX = 128;
                                        $centerY = 128;
                                    @endphp
                                    <svg width="256" height="256" class="transform -rotate-90">
                                        @foreach(['Sangat Baik', 'Baik', 'Cukup Baik', 'Kurang Baik'] as $index => $rating)
                                            @php
                                                $item = $skmData->firstWhere('jawab', $rating);
                                                $count = $item ? $item->jumlah : 0;
                                                $percentage = $totalVotes > 0 ? ($count / $totalVotes) : 0;
                                                $angle = $percentage * 360;
                                                $color = ['#10b981', '#3b82f6', '#eab308', '#ef4444'][$index];

                                                $x1 = $centerX + ($radius * cos(deg2rad($startAngle)));
                                                $y1 = $centerY + ($radius * sin(deg2rad($startAngle)));
                                                $x2 = $centerX + ($radius * cos(deg2rad($startAngle + $angle)));
                                                $y2 = $centerY + ($radius * sin(deg2rad($startAngle + $angle)));

                                                $largeArcFlag = $angle > 180 ? 1 : 0;
                                            @endphp

                                            @if($percentage > 0)
                                                <path
                                                    d="M {{ $centerX }} {{ $centerY }} L {{ $x1 }} {{ $y1 }} A {{ $radius }} {{ $radius }} 0 {{ $largeArcFlag }} 1 {{ $x2 }} {{ $y2 }} Z"
                                                    fill="{{ $color }}" stroke="white" stroke-width="2" opacity="0.9" />
                                            @endif

                                            @php $startAngle += $angle; @endphp
                                        @endforeach

                                        <!-- Center circle -->
                                        <circle cx="{{ $centerX }}" cy="{{ $centerY }}" r="40" fill="white" opacity="0.9" />
                                        <text x="{{ $centerX }}" y="{{ $centerY + 5 }}" text-anchor="middle"
                                            class="text-sm font-bold fill-gray-800 transform rotate-90"
                                            transform-origin="{{ $centerX }} {{ $centerY }}">{{ $totalVotes }}</text>
                                    </svg>
                                </div>
                            </div>

                            <div class="text-center">
                                <p class="text-lg font-semibold mb-2">Total Responden: {{ number_format($totalVotes) }}</p>
                                <p class="text-sm opacity-75">Terima kasih atas partisipasi Anda dalam survey kepuasan
                                    masyarakat</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white bg-opacity-10 rounded-2xl p-8 backdrop-blur-sm text-center">
                        <div class="text-6xl mb-4">📊</div>
                        <h3 class="text-2xl font-bold mb-4">Belum Ada Data Survey</h3>
                        <p class="text-lg opacity-90 mb-6">Jadilah yang pertama memberikan feedback tentang pelayanan kami
                        </p>
                        <button id="surveyMainButton"
                            class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors"
                            onclick="document.getElementById('surveyPopup').classList.remove('hidden')">
                            Isi Survey Sekarang
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if(isset($linkTerkait) && is_array($linkTerkait) && count($linkTerkait) > 0)
        <!-- Related Links Section -->
        <section class="bg-gradient-to-br from-gray-50 to-slate-100 py-20">
            <div class="container mx-auto px-4">
                <div class="text-center mb-16">
                    <h2
                        class="text-4xl lg:text-5xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
                        Link Terkait</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Jaringan website pemerintah dan instansi terkait
                        untuk informasi lebih lengkap</p>
                </div>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($linkTerkait as $link)
                        <a href="{{ $link['link'] ?? '#' }}" target="_blank"
                            class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 p-6 border border-gray-100 hover:scale-105">
                            @if(isset($link['logo']))
                                <div
                                    class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-4 mb-4 w-fit mx-auto group-hover:scale-110 transition-transform duration-300">
                                    <img src="{{ asset($link['logo']) }}" alt="{{ $link['nama'] ?? 'Website' }}"
                                        class="h-12 w-12 object-contain">
                                </div>
                            @endif
                            <h3 class="font-bold mb-2 text-gray-900 text-center group-hover:text-blue-600 transition-colors">
                                {{ $link['nama'] ?? 'Website Pemerintah' }}
                            </h3>
                            <p class="text-sm text-gray-500 line-clamp-2 text-center mb-4">
                                {{ $link['description'] ?? 'Website pemerintah terkait' }}
                            </p>
                            <div class="text-center">
                                <span
                                    class="inline-flex items-center text-sm text-blue-600 font-semibold group-hover:text-purple-600 transition-colors">
                                    Kunjungi Website
                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                        </path>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Already Completed Survey Notification -->
    <div class="fixed top-20 right-4 bg-white rounded-lg shadow-xl p-6 transform translate-x-full transition-transform duration-300 z-50 max-w-sm hidden"
        id="surveyCompletedNotification" style="transform: translateX(120%);">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-gray-900">Survey Sudah Diisi</h3>
                <p class="mt-1 text-sm text-gray-500">Terima kasih! Anda sudah memberikan feedback sebelumnya.</p>
            </div>
            <button onclick="hideCompletedNotification()"
                class="ml-auto flex-shrink-0 text-gray-400 hover:text-gray-500">
                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Survey Modal -->
    <div class="modal fixed inset-0 bg-black bg-opacity-50 hidden z-50" id="surveyPopup">
        <div class="modal-dialog flex items-center justify-center min-h-screen p-4">
            <form class="modal-content bg-white rounded-2xl max-w-2xl w-full p-8" id="formskm">
                <div class="modal-header flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-bold text-gray-900">Survey Kepuasan Masyarakat</h3>
                    <button id="surveyPopupClose" type="button"
                        class="text-gray-400 hover:text-gray-600 text-2xl">&times;</button>
                </div>

                <div id="surveyThanks" class="modal-body hidden text-center">
                    <div class="w-24 h-24 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Terima kasih atas waktunya</h2>
                </div>

                <div id="surveyBody" class="modal-body">
                    <h4 class="text-center text-lg text-gray-700 mb-8">
                        Bagaimana pendapat anda tentang pelayanan aplikasi JDIH Bagian Hukum Kota Banjarbaru?
                    </h4>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <label class="text-center cursor-pointer group" for="opsi4">
                            <input type="radio" name="jawab" id="opsi4" value="Kurang Baik" class="send hidden">
                            <div
                                class="p-4 border-2 border-gray-200 rounded-xl group-hover:border-red-300 transition-colors">
                                <div class="text-4xl mb-2">😞</div>
                                <span class="text-sm font-medium">Kurang Baik</span>
                            </div>
                        </label>

                        <label class="text-center cursor-pointer group" for="opsi3">
                            <input type="radio" name="jawab" id="opsi3" value="Cukup Baik" class="send hidden">
                            <div
                                class="p-4 border-2 border-gray-200 rounded-xl group-hover:border-yellow-300 transition-colors">
                                <div class="text-4xl mb-2">😐</div>
                                <span class="text-sm font-medium">Cukup Baik</span>
                            </div>
                        </label>

                        <label class="text-center cursor-pointer group" for="opsi2">
                            <input type="radio" name="jawab" id="opsi2" value="Baik" class="send hidden">
                            <div
                                class="p-4 border-2 border-gray-200 rounded-xl group-hover:border-blue-300 transition-colors">
                                <div class="text-4xl mb-2">🙂</div>
                                <span class="text-sm font-medium">Baik</span>
                            </div>
                        </label>

                        <label class="text-center cursor-pointer group" for="opsi1">
                            <input type="radio" name="jawab" id="opsi1" value="Sangat Baik" class="send hidden">
                            <div
                                class="p-4 border-2 border-gray-200 rounded-xl group-hover:border-green-300 transition-colors">
                                <div class="text-4xl mb-2">😊</div>
                                <span class="text-sm font-medium">Sangat Baik</span>
                            </div>
                        </label>
                    </div>
                </div>

                <div id="surveyFooter" class="modal-footer flex justify-between mt-8">
                    <button type="button" class="px-6 py-2 text-gray-600 hover:text-gray-800 transition-colors"
                        data-dismiss="modal">Nanti</button>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2 rounded-lg font-semibold transition-colors"
                        id="btnskm">
                        <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Kirim
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer id="kontak" class="bg-gray-900 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-4 gap-8">
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-4 mb-6">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="h-14 w-auto">
                        <div>
                            <h3 class="text-xl font-bold">JDIH Banjarbaru</h3>
                            <p class="text-gray-400">Kota Banjarbaru</p>
                        </div>
                    </div>
                    <p class="text-gray-400 mb-6">
                        Jaringan Dokumentasi dan Informasi Hukum (JDIH) Kota Banjarbaru
                        yang dikelola oleh Bagian Hukum dan Perundang-undangan.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-gray-800 p-3 rounded-lg hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                            </svg>
                        </a>
                        <a href="#" class="bg-gray-800 p-3 rounded-lg hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z" />
                            </svg>
                        </a>
                        <a href="#" class="bg-gray-800 p-3 rounded-lg hover:bg-gray-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.097.118.112.222.083.343-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z" />
                            </svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Menu Utama</h4>
                    <ul class="space-y-3">
                        <li><a href="#beranda" class="text-gray-400 hover:text-white transition-colors">Beranda</a></li>
                        <li><a href="#produk-hukum" class="text-gray-400 hover:text-white transition-colors">Produk
                                Hukum</a></li>
                        <li><a href="#statistik" class="text-gray-400 hover:text-white transition-colors">Statistik</a>
                        </li>
                        <li><a href="#kegiatan" class="text-gray-400 hover:text-white transition-colors">Kegiatan</a>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-lg font-semibold mb-4">Kontak</h4>
                    <ul class="space-y-3 text-gray-400">
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                            </svg>
                            <span>Banjarbaru, Kalimantan Selatan</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" />
                            </svg>
                            <span>(0511) 123-4567</span>
                        </li>
                        <li class="flex items-center space-x-2">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" />
                            </svg>
                            <span>jdih@banjarbarukota.go.id</span>
                        </li>
                    </ul>
                </div>
            </div>

            <hr class="border-gray-800 my-8">

            <!-- Visitor Statistics Section -->
            <div class="bg-gray-800 rounded-xl p-6 mb-8">
                <h4 class="text-lg font-semibold mb-4 text-center">Statistik Pengunjung</h4>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                    <div class="bg-gray-700 rounded-lg p-4">
                        <div class="text-3xl font-bold text-blue-400" id="visitor-today">0</div>
                        <div class="text-sm text-gray-400 mt-2">Hari Ini</div>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4">
                        <div class="text-3xl font-bold text-green-400" id="visitor-week">0</div>
                        <div class="text-sm text-gray-400 mt-2">Minggu Ini</div>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4">
                        <div class="text-3xl font-bold text-yellow-400" id="visitor-month">0</div>
                        <div class="text-sm text-gray-400 mt-2">Bulan Ini</div>
                    </div>
                    <div class="bg-gray-700 rounded-lg p-4">
                        <div class="text-3xl font-bold text-purple-400" id="visitor-total">0</div>
                        <div class="text-sm text-gray-400 mt-2">Total</div>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    <div class="inline-flex items-center bg-gray-700 rounded-lg px-4 py-2">
                        <svg class="w-4 h-4 text-green-400 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="4" />
                        </svg>
                        <span class="text-sm text-gray-300">Pengunjung Online: <span class="font-bold text-green-400"
                                id="visitor-online">0</span></span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm">
                    © {{ date('Y') }} Jaringan Dokumentasi dan Informasi Hukum Kota Banjarbaru. All rights reserved.
                </p>
                <p class="text-gray-400 text-sm mt-4 md:mt-0">
                    Bagian Hukum dan Perundang-undangan
                </p>
            </div>
        </div>
    </footer>

    <!-- Comprehensive JavaScript -->
    <script>
        // Mobile dropdown toggle function with nested support
        function toggleMobileDropdown(menuId) {
            const menu = document.getElementById(menuId);
            if (!menu) return;

            const isSubmenu = menuId.includes('submenu');
            const parentMenu = menu.closest('.mobile-accordion');

            if (!isSubmenu) {
                // For main level menus, close other main level menus
                const allMainMenus = document.querySelectorAll('.mobile-accordion > div[id$="-menu"]:not([id*="submenu"])');
                allMainMenus.forEach(m => {
                    if (m.id !== menuId) {
                        m.classList.add('hidden');
                        // Close all submenus within
                        const submenus = m.querySelectorAll('[id$="submenu"]');
                        submenus.forEach(sm => sm.classList.add('hidden'));
                        // Reset arrows
                        const button = m.previousElementSibling;
                        if (button) {
                            const svg = button.querySelector('svg');
                            if (svg) {
                                svg.style.transform = 'rotate(0deg)';
                            }
                        }
                        // Reset submenu arrows
                        m.querySelectorAll('button svg').forEach(svg => {
                            svg.style.transform = 'rotate(0deg)';
                        });
                    }
                });
            } else {
                // For submenus, close other submenus at the same level
                const siblingSubmenus = parentMenu.querySelectorAll('[id$="submenu"]');
                siblingSubmenus.forEach(sm => {
                    if (sm.id !== menuId) {
                        sm.classList.add('hidden');
                        const button = sm.previousElementSibling;
                        if (button) {
                            const svg = button.querySelector('svg');
                            if (svg) {
                                svg.style.transform = 'rotate(0deg)';
                            }
                        }
                    }
                });
            }

            // Toggle current menu with smooth animation
            const isHidden = menu.classList.contains('hidden');

            if (isHidden) {
                menu.classList.remove('hidden');
                menu.style.maxHeight = '0';
                menu.style.overflow = 'hidden';
                menu.style.transition = 'max-height 0.3s ease-out';
                setTimeout(() => {
                    menu.style.maxHeight = menu.scrollHeight + 'px';
                    setTimeout(() => {
                        menu.style.maxHeight = '';
                        menu.style.overflow = '';
                    }, 300);
                }, 10);
            } else {
                menu.style.maxHeight = menu.scrollHeight + 'px';
                menu.style.overflow = 'hidden';
                menu.style.transition = 'max-height 0.3s ease-out';
                setTimeout(() => {
                    menu.style.maxHeight = '0';
                    setTimeout(() => {
                        menu.classList.add('hidden');
                        menu.style.maxHeight = '';
                        menu.style.overflow = '';
                    }, 300);
                }, 10);
            }

            // Rotate arrow
            const button = menu.previousElementSibling;
            if (button) {
                const svg = button.querySelector('svg');
                if (svg) {
                    svg.style.transform = isHidden ? 'rotate(180deg)' : 'rotate(0deg)';
                    svg.style.transition = 'transform 0.3s';
                }
            }
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Quick search function for popular search badges
        function applyQuickSearch(tipe, searchText, status, tahun) {
            // Set form values
            if (tipe) document.getElementById('tipe').value = tipe;
            if (searchText) document.getElementById('textsearch').value = searchText;
            if (status && status !== 'ALL') document.getElementById('status').value = status;
            if (tahun && tahun !== 'ALL') document.getElementById('tahun').value = tahun;

            // Scroll to search form smoothly
            document.getElementById('textsearch').scrollIntoView({ behavior: 'smooth', block: 'center' });

            // Highlight the search input briefly to show it's been updated
            const searchInput = document.getElementById('textsearch');
            searchInput.classList.add('ring-4', 'ring-blue-400', 'ring-opacity-50');
            setTimeout(() => {
                searchInput.classList.remove('ring-4', 'ring-blue-400', 'ring-opacity-50');
            }, 2000);

            // Optional: Auto-trigger search after a brief delay
            setTimeout(() => {
                // Trigger the search button click
                document.getElementById('btnsearch').click();
            }, 1500);
        }

        // Search functionality
        document.getElementById('btnsearch').addEventListener('click', function () {
            const status = document.getElementById('status').value || 'ALL';
            const tipe = document.getElementById('tipe').value;
            const textsearch = document.getElementById('textsearch').value;
            const tahun = document.getElementById('tahun').value;

            if (tipe !== '' || textsearch !== '') {
                let link = "/";
                const params = [];

                // If type is selected, add it to the URL path
                if (tipe !== '') {
                    link += tipe;
                }

                if (textsearch !== '') {
                    params.push('s=' + encodeURIComponent(textsearch));
                }
                if (tahun !== 'ALL' && tahun !== '') {
                    params.push('tahun=' + tahun);
                }
                if (status !== 'ALL' && status !== '') {
                    params.push('status=' + status);
                }

                if (params.length > 0) {
                    link += '?' + params.join('&');
                }

                window.location.href = link;
            } else {
                // Show alert if no search criteria is provided
                alert('Silakan pilih jenis dokumen atau masukkan kata kunci pencarian.');
            }
        });

        // Contact form WhatsApp integration
        document.getElementById('konsul').addEventListener('submit', function (event) {
            event.preventDefault();

            const nama = document.getElementById('nama').value;
            const email = document.getElementById('email').value;
            const subjek = document.getElementById('subjek').value;
            const pesan = document.getElementById('pesan').value;

            const message = `*Nama:* ${nama}\n*Email:* ${email}\n*Subjek:* ${subjek}\n\n*Pesan:*\n${pesan}`;
            const phoneNumber = '6282155720388';
            const whatsappUrl = `https://api.whatsapp.com/send/?phone=${phoneNumber}&text=${encodeURIComponent(message)}&app_absent=0`;

            window.open(whatsappUrl, '_blank');
        });

        // Survey Modal functionality
        const surveyModal = document.getElementById('surveyPopup');
        const surveyClose = document.getElementById('surveyPopupClose');
        const surveyForm = document.getElementById('formskm');

        // Check if user has already completed survey
        function hasCompletedSurvey() {
            return localStorage.getItem('survey_completed') === 'true';
        }

        // Close modal functions
        function closeSurveyModal() {
            surveyModal.classList.add('hidden');
        }

        surveyClose.addEventListener('click', closeSurveyModal);
        document.querySelector('[data-dismiss="modal"]').addEventListener('click', closeSurveyModal);

        surveyModal.addEventListener('click', function (e) {
            if (e.target === surveyModal) {
                closeSurveyModal();
            }
        });

        // Survey form submission
        surveyForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            // Send data to API
            fetch('/api/skm', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                }
            })
                .then(response => response.json())
                .then(data => {
                    // Show thank you message
                    document.getElementById('surveyBody').classList.add('hidden');
                    document.getElementById('surveyFooter').classList.add('hidden');
                    document.getElementById('surveyThanks').classList.remove('hidden');

                    // Store in localStorage to prevent showing survey again
                    localStorage.setItem('survey_completed', 'true');

                    // Auto close after 3 seconds and refresh page to show updated stats
                    setTimeout(() => {
                        closeSurveyModal();
                        window.location.reload();
                    }, 3000);
                })
                .catch(error => {
                    console.error('Error submitting survey:', error);
                    // Show thank you message anyway
                    document.getElementById('surveyBody').classList.add('hidden');
                    document.getElementById('surveyFooter').classList.add('hidden');
                    document.getElementById('surveyThanks').classList.remove('hidden');

                    setTimeout(closeSurveyModal, 3000);
                });
        });

        // Show survey modal after 20 seconds (optional)
        // setTimeout(() => {
        //     if (!localStorage.getItem('survey_completed')) {
        //         surveyModal.classList.remove('hidden');
        //     }
        // }, 20000);

        // Load Tema Dokumen via AJAX
        function loadTemaDokumen() {
            fetch('/api/tema-dokumen')
                .then(response => response.json())
                .then(data => {
                    const container = document.getElementById('tema-dokumen-container');

                    if (data.data && data.data.length > 0) {
                        container.innerHTML = data.data.map(tema => {
                            if (tema.status) {
                                const jumlahPeraturan = tema.jumlah_peraturan || 0;
                                const iconSrc = tema.icon || `/assets/images/${tema.slug}.png`;

                                return `
                                    <a href="/tema-dokumen/${tema.id}/${tema.slug}" class="flex flex-col items-center text-center p-4 bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 card-hover group">
                                        <img src="${iconSrc}" alt="${tema.nama}" class="w-20 h-20 mb-4 group-hover:scale-110 transition-transform duration-300" onerror="this.src='/assets/images/default-tema.png'">
                                        <h3 class="font-bold text-gray-900 mb-2">${tema.nama}</h3>
                                        <small class="text-gray-600">${jumlahPeraturan} Peraturan</small>
                                    </a>
                                `;
                            }
                        }).join('');
                    } else {
                        container.innerHTML = '<p class="text-center text-gray-500">Belum ada tema dokumen yang tersedia</p>';
                    }
                })
                .catch(error => {
                    console.error('Error loading tema dokumen:', error);
                    document.getElementById('tema-dokumen-container').innerHTML = '<p class="text-center text-red-500">Gagal memuat data tema dokumen</p>';
                });
        }

        // Load Penghargaan via AJAX
        function loadPenghargaan() {
            const penghargaanUrl = '{{ env("JDIH_SVC_PENGHARGAAN_URL") }}';
            const container = document.getElementById('penghargaan-list');
            const fallback = document.getElementById('penghargaan-fallback');

            if (penghargaanUrl) {
                fetch(penghargaanUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.data && data.data.length > 0) {
                            container.innerHTML = data.data.map(penghargaan => {
                                const image = penghargaan.image || '/assets/images/piagam.png';
                                return `
                                    <div class="group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 p-6 border border-gray-100 hover:scale-105">
                                        <a href="${image}" target="_blank" class="block">
                                            <div class="aspect-square mb-6 overflow-hidden rounded-2xl bg-gradient-to-br from-blue-50 to-indigo-50 p-4">
                                                <img src="${image}" alt="${penghargaan.nama}" class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-500">
                                            </div>
                                            <h3 class="text-center font-bold text-gray-900 text-lg mb-2 group-hover:text-blue-600 transition-colors">${penghargaan.nama}</h3>
                                            <div class="text-center">
                                                <span class="inline-flex items-center text-sm text-blue-600 font-semibold group-hover:text-purple-600 transition-colors">
                                                    Lihat Detail
                                                    <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </span>
                                            </div>
                                        </a>
                                    </div>
                                `;
                            }).join('');
                            container.classList.remove('hidden');
                            fallback.classList.add('hidden');
                        } else {
                            container.classList.add('hidden');
                            fallback.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error loading penghargaan:', error);
                        container.classList.add('hidden');
                        fallback.classList.remove('hidden');
                    });
            } else {
                container.classList.add('hidden');
                fallback.classList.remove('hidden');
            }
        }

        // Hero Slider functionality
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;
        let slideInterval;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.classList.toggle('opacity-100', i === index);
                slide.classList.toggle('opacity-0', i !== index);
            });

            // Update pagination dots
            document.querySelectorAll('.pagination-dot').forEach((dot, i) => {
                dot.classList.toggle('bg-white', i === index);
                dot.classList.toggle('bg-white/50', i !== index);
            });

            currentSlide = index;
        }

        function nextSlide() {
            const next = (currentSlide + 1) % totalSlides;
            showSlide(next);
        }

        function prevSlide() {
            const prev = (currentSlide - 1 + totalSlides) % totalSlides;
            showSlide(prev);
        }

        function startSlideshow() {
            if (totalSlides > 1) {
                slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
            }
        }

        function stopSlideshow() {
            clearInterval(slideInterval);
        }

        // Initialize slider controls
        if (totalSlides > 1) {
            // Navigation arrows
            document.querySelector('.slider-next')?.addEventListener('click', () => {
                stopSlideshow();
                nextSlide();
                startSlideshow();
            });

            document.querySelector('.slider-prev')?.addEventListener('click', () => {
                stopSlideshow();
                prevSlide();
                startSlideshow();
            });

            // Pagination dots
            document.querySelectorAll('.pagination-dot').forEach((dot, index) => {
                dot.addEventListener('click', () => {
                    stopSlideshow();
                    showSlide(index);
                    startSlideshow();
                });
            });

            // Pause on hover
            const heroSlider = document.querySelector('.hero-slider');
            if (heroSlider) {
                heroSlider.addEventListener('mouseenter', stopSlideshow);
                heroSlider.addEventListener('mouseleave', startSlideshow);
            }
        }

        // Initialize on DOM load
        document.addEventListener('DOMContentLoaded', function () {
            loadTemaDokumen();
            // loadPenghargaan(); // Removed - now using PHP data
            startSlideshow(); // Start the hero slider

            // Check if user has completed survey and update UI accordingly
            if (hasCompletedSurvey()) {
                hideSurveyButtons();
                updateSurveySection();
            } else {
                setupSurveyButtons();
            }
        });

        // Hide all survey buttons if user has completed survey
        function hideSurveyButtons() {
            const surveyTriggers = document.querySelectorAll('[onclick*="surveyPopup"]');
            surveyTriggers.forEach(trigger => {
                // Hide the button completely
                trigger.style.display = 'none';
            });
        }

        // Update the survey section to show completion message
        function updateSurveySection() {
            const surveyMainButton = document.getElementById('surveyMainButton');
            if (surveyMainButton) {
                // Replace button with completion message
                const completionMessage = document.createElement('div');
                completionMessage.className = 'bg-green-100 text-green-700 px-6 py-3 rounded-lg font-semibold inline-flex items-center';
                completionMessage.innerHTML = `
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Survey Sudah Anda Isi - Terima Kasih!
                `;
                surveyMainButton.parentNode.replaceChild(completionMessage, surveyMainButton);
            }
        }

        // Setup all survey buttons with localStorage check
        function setupSurveyButtons() {
            // Get all elements that trigger the survey modal
            const surveyTriggers = document.querySelectorAll('[onclick*="surveyPopup"]');

            surveyTriggers.forEach(trigger => {
                // Remove the inline onclick
                trigger.removeAttribute('onclick');

                // Add new click handler with localStorage check
                trigger.addEventListener('click', function (e) {
                    e.preventDefault();

                    if (hasCompletedSurvey()) {
                        // Show custom notification that survey has already been completed
                        showCompletedNotification();
                        return;
                    }

                    // Show the survey modal
                    surveyModal.classList.remove('hidden');
                });
            });
        }

        // Show notification that survey was already completed
        function showCompletedNotification() {
            const notification = document.getElementById('surveyCompletedNotification');
            // First remove hidden class and reset transform
            notification.classList.remove('hidden');
            notification.style.transform = 'translateX(120%)';

            // Then animate in after a brief delay
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 10);

            // Auto hide after 5 seconds
            setTimeout(() => {
                hideCompletedNotification();
            }, 5000);
        }

        // Hide the completed notification
        function hideCompletedNotification() {
            const notification = document.getElementById('surveyCompletedNotification');
            notification.style.transform = 'translateX(120%)';

            // Hide completely after animation
            setTimeout(() => {
                notification.classList.add('hidden');
            }, 300);
        }

        // Visitor Statistics Counter Animation
        function animateCounter(elementId, targetValue, duration = 2000) {
            const element = document.getElementById(elementId);
            if (!element) return;

            const startValue = 0;
            const startTime = performance.now();

            function updateCounter(currentTime) {
                const elapsed = currentTime - startTime;
                const progress = Math.min(elapsed / duration, 1);

                // Easing function for smooth animation
                const easeOutQuart = 1 - Math.pow(1 - progress, 4);
                const currentValue = Math.floor(startValue + (targetValue - startValue) * easeOutQuart);

                element.textContent = currentValue.toLocaleString('id-ID');

                if (progress < 1) {
                    requestAnimationFrame(updateCounter);
                }
            }

            requestAnimationFrame(updateCounter);
        }

        // Initialize visitor statistics when the footer comes into view
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const statsObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting && !entry.target.dataset.animated) {
                    // Mark as animated to prevent re-animation
                    entry.target.dataset.animated = 'true';

                    // Simulate visitor statistics (replace with actual API calls)
                    animateCounter('visitor-today', Math.floor(Math.random() * 500) + 100);
                    animateCounter('visitor-week', Math.floor(Math.random() * 3000) + 1000);
                    animateCounter('visitor-month', Math.floor(Math.random() * 10000) + 5000);
                    animateCounter('visitor-total', Math.floor(Math.random() * 100000) + 50000);
                    animateCounter('visitor-online', Math.floor(Math.random() * 50) + 10);
                }
            });
        }, observerOptions);

        // Observe the visitor statistics section
        const visitorStatsSection = document.querySelector('.bg-gray-800.rounded-xl');
        if (visitorStatsSection) {
            statsObserver.observe(visitorStatsSection);
        }

        // Mobile menu toggle with improved animations
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileMenuIcon = document.getElementById('mobile-menu-icon');

        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function () {
                const isHidden = mobileMenu.classList.contains('hidden');

                if (isHidden) {
                    mobileMenu.classList.remove('hidden');
                    // Add slide-down animation
                    mobileMenu.style.maxHeight = '0';
                    setTimeout(() => {
                        mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
                    }, 10);
                    // Change hamburger to X
                    mobileMenuIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    `;
                } else {
                    // Slide-up animation
                    mobileMenu.style.maxHeight = '0';
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                        mobileMenu.style.maxHeight = '';
                    }, 300);
                    // Change X back to hamburger
                    mobileMenuIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    `;
                }
            });

            // Close mobile menu when clicking on a link
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', () => {
                    mobileMenu.style.maxHeight = '0';
                    setTimeout(() => {
                        mobileMenu.classList.add('hidden');
                        mobileMenu.style.maxHeight = '';
                    }, 300);
                    mobileMenuIcon.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    `;
                });
            });
        }

        // Radio button visual feedback for survey
        document.querySelectorAll('input[name="jawab"]').forEach(radio => {
            radio.addEventListener('change', function () {
                // Reset all borders
                document.querySelectorAll('input[name="jawab"]').forEach(r => {
                    r.closest('label').querySelector('div').classList.remove('border-green-500', 'border-blue-500', 'border-yellow-500', 'border-red-500');
                    r.closest('label').querySelector('div').classList.add('border-gray-200');
                });

                // Highlight selected
                const label = this.closest('label');
                const div = label.querySelector('div');
                div.classList.remove('border-gray-200');

                if (this.value === 'Sangat Baik') {
                    div.classList.add('border-green-500');
                } else if (this.value === 'Baik') {
                    div.classList.add('border-blue-500');
                } else if (this.value === 'Cukup Baik') {
                    div.classList.add('border-yellow-500');
                } else {
                    div.classList.add('border-red-500');
                }
            });
        });
    </script>
</body>

</html>
