<!-- footer start -->
<style>
    .footer-links,
    .social-bottom ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li a {
        color: #d6dbdb;
    }

    .footer-links li a:hover {
        color: #fff;
    }

    .footer-links li {
        margin-bottom: 5px;
    }

    .social-bottom ul {
        display: flex;
        flex-direction: row;
        gap: 10px;
    }

    .social-bottom ul li a {
        color: #d6dbdb;
        font-size: 28px;
    }
</style>
<footer class="footer" style="background:#383838; color:#dcdfe6">
    <div class="container-fluid">
        <div class="row mb-0">
            <div class="col-md-4">
                <div class="mb-2 float-left">
                    <img src="{{ asset('assets/images/landing/logo-light.png') }}" alt="" height="40">
                    <p class="mt-2">Terwujudnya Kota Banjarbaru sebagai Kota empat dimensi mandiri dan terdepan.
                        Terciptanya kepastian hukum/jaminan hukum, perlindungan hukum serta ketertiban hukum dan
                        tegaknya supremasi hukum. Terciptanya masyarakat, aman damai dan sejahtera. </p>
                </div>
            </div>
            <div class="col-md-2">
                <h5 class="text translate text-white f-17">Tentang Kami</h5>
                <ul class="footer-links mb-0 mt-2">
                    <li><a href="/sejarah" target="_blank">Sejarah JDIH</a></li>
                    <li><a href="/visi-misi" target="_blank">Visi Misi</a></li>
                    <li><a href="/makna-logo" target="_blank">Makna Logo</a></li>
                    <li><a href="/susunan-organisasi" target="_blank">Sususnan Organisasi</a></li>
                    <li><a href="/tim-pengelola" target="_blank">Tim Pengelola</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h5 class="text translate text-white f-17">Produk Hukum</h5>
                <ul class="footer-links mb-0 mt-2">
                    <li><a href="/perda" target="_blank">Peraturan Daerah</a></li>
                    <li><a href="/perwal" target="_blank">Peraturan Walikota</a></li>
                    <li><a href="/keputusan-wali-kota" target="_blank">Keputusan Walikota</a></li>
                    <li><a href="/propemperda" target="_blank">Propemperda</a></li>
                    <li><a href="/putusanpengadilan-negeri" target="_blank">Putusan Pengadilan Negeri</a></li>
                    <li><a href="/putusanpengadilan-tu-negara" target="_blank">Putusan Pengadilan Tata Usaha Negara</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-2">
                <h4 class="text translate" style="color:#dcdfe6">Statistik Pengunjung</h4>
                <div class="textwidget">
                    <table>
                        <tbody>
                            <tr>
                                <td><span class="ti-eye" style="margin-right:10px;"></span></td>
                                <td style="width:110px">Views</td>
                                <td>{{ $stats->pageviews->value ?? 14.420 }}</td>
                            </tr>
                            <tr>
                                <td><span class="ti-eye" style="margin-right:10px;"></span></td>
                                <td style="width:110px">Views Today</td>
                                <td>{{ $stats->pageviews->value ?? 13 }}</td>
                            </tr>
                            <tr>
                                <td><span class="ti-user" style="margin-right:10px;"></span></td>
                                <td>Visitor</td>
                                <td>{{ $stats->uniques->value ?? 6.419 }}</td>
                            </tr>
                            <tr>
                                <td><span class="ti-user" style="margin-right:10px;"></span></td>
                                <td>Visitor Today</td>
                                <td>{{ $stats->uniques->value ?? 7 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2">
                <h5 class="text translate text-white f-17">Sosial Media</h5>
                <p>Tetap terhubung dengan kami, lihat aktifitas dan update terbaru</p>
                <div class="social-bottom">
                    <ul>
                        @foreach ($social as $item)
                            @if ($item)
                                <li><a href="{{ $item->link }}" target="_blank"><i
                                            class="{{ $item->icon }}"></i></a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row mt-3">
            <div class="col-lg-12">
                <div class="float-left pull-none">
                    <p class="">2024 © Kota Banjarbaru.</p>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->
</footer>
<!-- footer end -->
