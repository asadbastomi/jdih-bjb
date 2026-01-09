<!--Navbar Start-->
<nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky sticky-dark ">
    <div class="top-social">
        <div class="container-fluid">
            <div class="info-nav">
                <ul>
                    <li style="display: flex;gap: 5px;margin-right: 10px;">
                        <i class="mdi mdi-phone"></i> <span class="d-none d-md-block">(0511) 4772569</span>
                    </li>
                    <li style="display: flex;gap: 5px;margin-right: 10px;">
                        <i class="mdi mdi-email"></i> <span class="d-none d-md-block">jdih@banjarbarukota.go.id</span>
                    </li>
                </ul>
            </div>
            <div class="social-nav">
                <ul>
                    @foreach ($social as $item)
                        @if ($item)
                            <li><a href="{{ $item->link }}" target="_blank"><i class="{{ $item->icon }}"></i></a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <ul class="lang-nav navbar-nav">
                <li class="dropdown d-none topbar-dropdown">
                    <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ $lang_trans[app()->getLocale()]->icon }}" alt="user-image" height="28">
                        {{ translateIt($lang_trans[app()->getLocale()]->text) }}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <!-- item-->
                        @foreach ($lang_trans as $id => $flag)
                            <a href="{{ route('localization.switch', $id) }}" class="dropdown-item">
                                <img src="{{ $flag->icon }}" alt="user-image" class="mr-1" height="24"> <span
                                    class="align-middle">{{ translateIt($flag->text) }}</span>
                            </a>
                        @endforeach
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="inner-navbar container-fluid">
        <!-- LOGO -->
        <a class="logo text-uppercase" href="/">
            <img src="{{ asset('assets/images/logo.png') }}" alt="" class="logo-dark" />
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
            aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <i class="mdi mdi-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mx-auto navbar-center" id="mySidenav">
                <li class="nav-item ">
                    <a href="/" class="nav-link">{{ translateIt('Beranda') }}</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link">{{ translateIt('Profil') }}</a>
                    <ul>
                        <li class="nav-item">
                            <a href="/sambutan" class="nav-link">{{ translateIt('Sambutan Kabag. Hukum') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/visi-misi" class="nav-link">{{ translateIt('Visi Misi') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/makna-logo" class="nav-link">{{ translateIt('Makna Logo') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/sejarah-banjarbaru" class="nav-link">{{ translateIt('Sejarah Banjarbaru') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/sejarah" class="nav-link">{{ translateIt('Sejarah') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/tupoksi" class="nav-link">{{ translateIt('Tugas Pokok') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/tim-pengelola" class="nav-link">{{ translateIt('Tim Pengelola') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/sk" class="nav-link">{{ translateIt('SK Tim JDIH') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/perwalipengelola"
                                class="nav-link">{{ translateIt('Perwali Pengelolaan JDIH') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/susunan-organisasi" class="nav-link">{{ translateIt('Susunan Organisasi') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/pustaka" class="nav-link">{{ translateIt('Pustaka JDIH') }}</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link"
                        style="white-space: nowrap;">{{ translateIt('Produk Hukum') }}</a>
                    <ul>
                        <li class="nav-item">
                            <a href="/perda" class="nav-link">{{ translateIt('Peraturan Daerah') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/perwal" class="nav-link">{{ translateIt('Peraturan Wali Kota') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/keputusan-wali-kota"
                                class="nav-link">{{ translateIt('Keputusan Wali Kota') }}</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link"
                        style="white-space: nowrap;">{{ translateIt('Data Perkara') }}</a>
                    <ul>
                        <li class="nav-item">
                            <a href="/putusanpengadilan-negeri"
                                class="nav-link">{{ translateIt('Putusan Pengadilan Negeri') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/putusanpengadilan-tu-negara"
                                class="nav-link">{{ translateIt('Putusan Pengadilan Tata Usaha Negara') }}</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/propemperda" class="nav-link">Propemperda</a>
                </li>
                <li class="nav-item">
                    <a href="/artikel" class="nav-link">Artikel</a>
                </li>
                <li class="nav-item">
                    <a href="/kegiatan" class="nav-link">{{ translateIt('Kegiatan') }}</a>
                    <ul>
                        <li class="nav-item">
                            <a href="/kegiatan/cat/sosialisasi" class="nav-link">{{ translateIt('Sosialisasi') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/kegiatan/cat/kadarkum" class="nav-link">{{ translateIt('Kadarkum') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/kegiatan/cat/workshop"
                                class="nav-link">{{ translateIt('Bimtek/Workshop') }}</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/inovasi" class="nav-link">{{ translateIt('Inovasi') }}</a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link">{{ translateIt('Informasi') }}</a>
                    <ul>
                        <li class="nav-item">
                            <a href="/pengumuman" class="nav-link">{{ translateIt('Relaas') }}</a>
                        </li>
                        <li class="nav-item">
                            <a href="/monograf-hukum" class="nav-link">{{ translateIt('Monografi Hukum') }}</a>
                        </li>
                </li>
                <li class="nav-item">
                    <a href="/kontak" class="nav-link">{{ translateIt('Kontak') }}</a>
                </li>
            </ul>
            </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Navbar End -->
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
