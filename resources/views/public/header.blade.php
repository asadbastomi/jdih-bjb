<!-- Survey popup -->
<script src="{{asset('assets/js/survey-popup.js')}}"></script>

<style>
    /* Modern SaaS-style Navigation */
    .modern-navbar {
        background: #ffffff;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .navbar-scrolled {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .top-bar {
        background: var(--gradient-primary);
        color: white;
        padding: 8px 0;
        font-size: 0.85rem;
        position: relative;
        z-index: 1001;
    }

    .top-bar a {
        color: rgba(255, 255, 255, 0.9);
        transition: color 0.3s ease;
    }

    .top-bar a:hover {
        color: white;
    }

    .main-navbar {
        padding: 1rem 0;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        font-weight: 700;
        font-size: 1.25rem;
        color: #2c3e50;
        transition: transform 0.3s ease;
    }

    .navbar-brand:hover {
        transform: translateY(-2px);
        color: #1e3c72;
    }

    .navbar-brand img {
        height: 40px;
        margin-right: 10px;
    }

    .nav-link {
        font-weight: 500;
        color: #4a5568 !important;
        margin: 0 0.25rem;
        padding: 0.5rem 0.75rem !important;
        border-radius: 8px;
        transition: all 0.3s ease;
        position: relative;
        font-size: 0.9rem;
        white-space: nowrap;
    }

    .nav-link:hover {
        color: #1e3c72 !important;
        background-color: rgba(30, 60, 114, 0.05);
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 50%;
        background-color: #1e3c72;
        transition: all 0.3s ease;
    }

    .nav-link:hover::after {
        width: 80%;
        left: 10%;
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        padding: 0.5rem 0;
        margin-top: 0.25rem;
        animation: fadeInUp 0.3s ease;
        background: #fff;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        padding: 0.6rem 1.5rem;
        font-weight: 500;
        color: #4a5568;
        transition: all 0.2s ease;
        border-radius: 8px;
        margin: 0 0.5rem;
        display: flex;
        align-items: center;
    }

    .dropdown-item:hover {
        background-color: rgba(30, 60, 114, 0.05);
        color: #1e3c72;
        transform: translateX(5px);
        text-decoration: none;
    }

    .dropdown-divider {
        height: 1px;
        margin: 0.5rem 0;
        overflow: hidden;
        border-top: 1px solid #e9ecef;
    }

    .dropdown-toggle::after {
        display: none !important;
    }

    .dropdown-toggle .chevron-icon {
        margin-left: 0.3rem;
        font-size: 0.8rem;
        transition: transform 0.3s ease;
        display: inline-block;
        vertical-align: middle;
    }

    .dropdown-toggle[aria-expanded="true"] .chevron-icon {
        transform: rotate(180deg);
    }

    .language-selector {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 0.8rem;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        text-decoration: none;
        color: rgba(255, 255, 255, 0.9);
    }

    .language-selector:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        text-decoration: none;
    }

    .navbar-toggler {
        border: none;
        padding: 4px 8px;
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    .social-links a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        margin-left: 0.5rem;
        transition: all 0.3s ease;
    }

    .social-links a:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    /* Tablet adjustments */
    @media (max-width: 1200px) {
        .nav-link {
            font-size: 0.85rem;
            padding: 0.5rem 0.6rem !important;
            margin: 0 0.2rem;
        }

        .chevron-icon {
            font-size: 0.7rem;
        }
    }

    /* Mobile adjustments */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            background: white;
            border-radius: 12px;
            padding: 1rem;
            margin-top: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .nav-link {
            margin: 0.25rem 0;
            padding: 0.5rem 1rem !important;
            font-size: 0.95rem;
        }
    }
</style>

<!-- Top Bar -->
<div class="top-bar">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-none d-md-flex align-items-center flex-wrap">
                    <i class="mdi mdi-phone mr-2"></i>
                    <span class="mr-3 d-none d-md-inline">(0511) 4772569</span>
                    <i class="mdi mdi-email mr-2"></i>
                    <span class="d-none d-md-inline">jdih@banjarbarukota.go.id</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex align-items-center justify-content-md-end flex-wrap">
                    <!-- Social Links -->
                    <div class="social-links d-flex align-items-center mr-3">
                        @foreach ($social as $item)
                            @if ($item)
                                <a href="{{ $item->link }}" target="_blank">
                                    <i class="{{ $item->icon }}"></i>
                                </a>
                            @endif
                        @endforeach
                    </div>

                    <!-- Language Selector -->
                    <div class="dropdown">
                        <a class="language-selector dropdown-toggle" href="#" id="languageDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ $lang_trans[app()->getLocale()]->icon }}" alt="language-flag" height="20">
                            <span>{{ translateIt($lang_trans[app()->getLocale()]->text) }}</span>
                            <i class="mdi mdi-chevron-down chevron-icon"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="languageDropdown" style="background: #fff; min-width: 160px; margin-top: 0.25rem;">
                            @foreach ($lang_trans as $id => $flag)
                                <a class="dropdown-item" href="{{ route('localization.switch', $id) }}" style="color: #4a5568; display: flex; align-items: center;">
                                    <img src="{{ $flag->icon }}" alt="language-flag" height="20" class="mr-2">
                                    <span>{{ translateIt($flag->text) }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Main Navigation -->
<nav class="navbar navbar-expand-lg navbar-light modern-navbar">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('assets/images/logo.png') }}" alt="JDIH Banjarbaru" />
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav" style="margin: 0 auto; display: flex; align-items: center;">
                <li class="nav-item">
                    <a class="nav-link" href="/">{{ translateIt('Beranda') }}</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profilDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ translateIt('Profil') }}
                        <i class="mdi mdi-chevron-down chevron-icon"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="profilDropdown">
                        <a class="dropdown-item" href="/sambutan">{{ translateIt('Sambutan Kabag. Hukum') }}</a>
                        <a class="dropdown-item" href="/visi-misi">{{ translateIt('Visi Misi') }}</a>
                        <a class="dropdown-item" href="/makna-logo">{{ translateIt('Makna Logo') }}</a>
                        <a class="dropdown-item" href="/sejarah-banjarbaru">{{ translateIt('Sejarah Banjarbaru') }}</a>
                        <a class="dropdown-item" href="/sejarah">{{ translateIt('Sejarah') }}</a>
                        <a class="dropdown-item" href="/tupoksi">{{ translateIt('Tugas Pokok') }}</a>
                        <a class="dropdown-item" href="/tim-pengelola">{{ translateIt('Tim Pengelola') }}</a>
                        <a class="dropdown-item" href="/sk">{{ translateIt('SK Tim JDIH') }}</a>
                        <a class="dropdown-item" href="/perwalipengelola">{{ translateIt('Perwali Pengelolaan JDIH') }}</a>
                        <a class="dropdown-item" href="/susunan-organisasi">{{ translateIt('Susunan Organisasi') }}</a>
                        <a class="dropdown-item" href="/sop">{{ translateIt('SOP') }}</a>
                        <a class="dropdown-item" href="/galeri">{{ translateIt('Galeri Foto') }}</a>
                        <a class="dropdown-item" href="/pustaka">{{ translateIt('Pustaka JDIH') }}</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="produkHukumDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ translateIt('Produk Hukum') }}
                        <i class="mdi mdi-chevron-down chevron-icon"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="produkHukumDropdown">
                        <a class="dropdown-item" href="/perda">{{ translateIt('Peraturan Daerah') }}</a>
                        <a class="dropdown-item" href="/perwal">{{ translateIt('Peraturan Wali Kota') }}</a>
                        <a class="dropdown-item" href="/keputusan-wali-kota">{{ translateIt('Keputusan Wali Kota') }}</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dataPerkaraDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ translateIt('Data Perkara') }}
                        <i class="mdi mdi-chevron-down chevron-icon"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dataPerkaraDropdown">
                        <a class="dropdown-item" href="/putusanpengadilan-negeri">{{ translateIt('Putusan Pengadilan Negeri') }}</a>
                        <a class="dropdown-item" href="/putusanpengadilan-tu-negara">{{ translateIt('Putusan Pengadilan Tata Usaha Negara') }}</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/propemperda">Propemperda</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="kegiatanDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ translateIt('Kegiatan') }}
                        <i class="mdi mdi-chevron-down chevron-icon"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="kegiatanDropdown">
                        <a class="dropdown-item" href="/kegiatan/cat/sosialisasi">{{ translateIt('Sosialisasi') }}</a>
                        <a class="dropdown-item" href="/kegiatan/cat/kadarkum">{{ translateIt('Kadarkum') }}</a>
                        <a class="dropdown-item" href="/kegiatan/cat/workshop">{{ translateIt('Bimtek/Workshop') }}</a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="lainnyaDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ translateIt('Lainnya') }}
                        <i class="mdi mdi-chevron-down chevron-icon"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="lainnyaDropdown">
                        <a class="dropdown-item" href="/artikel">Artikel</a>
                        <a class="dropdown-item" href="/inovasi">{{ translateIt('Inovasi') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">{{ translateIt('Informasi') }}</a>
                        <a class="dropdown-item" href="/pengumuman">{{ translateIt('Relaas') }}</a>
                        <a class="dropdown-item" href="/monograf-hukum">{{ translateIt('Monografi Hukum') }}</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/kontak">{{ translateIt('Kontak') }}</a>
                        <a class="dropdown-item" href="/faq">{{ translateIt('FAQ') }}</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    // Add scroll effect to navbar
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.modern-navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }
    });
</script>

{{-- <section id="breaking-news">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="sitewidth cd-headline zoom">
                <div class="br-title">{{ translateIt('Produk Hukum Terbaru') }}</div>
                <span class="cd-words-wrapper">
                    @foreach ($regulasi as $key => $r)
                    <b class="<?php echo $loop->first ? 'is-visible' : 'is-hidden'; ?>">
                        <a
                            href="{{ $r->nama_singkat . '?s=' . strtolower(str_replace(' ', '-', $r->nomor)) . '&det=true' }}">
                            <span class="kathukum">{{ $r->nama_singkat }}</span>
                            <div class="katdet">
                                <strong>{{ translateIt(strftime('%d %B %Y', strtotime($r->tanggal_diundangkan)))
                                    }}</strong>
                                <span>{{ translateIt('Nomor ' . $r->nomor . ' Tahun ' . $r->tahun . ' - ' . $r->judul)
                                    }}</span>
                            </div>
                        </a>
                    </b>
                    @endforeach
                </span>
            </div>
        </div>
    </div> <!-- end container-fluid -->
</section> --}}
