<!-- footer start -->
<style>
    /* CSS Variables */
    :root {
        --primary-color: #6366f1;
        --primary-dark: #4f46e5;
        --primary-light: #818cf8;
        --secondary-color: #8b5cf6;
        --accent-color: #ec4899;
        --success-color: #10b981;
        --warning-color: #f59e0b;
        --info-color: #06b6d4;
        --danger-color: #ef4444;
        --light-color: #f8fafc;
        --dark-color: #1e293b;
        --gray-50: #f8fafc;
        --gray-100: #f1f5f9;
        --gray-200: #e2e8f0;
        --gray-300: #cbd5e1;
        --gray-400: #94a3b8;
        --gray-500: #64748b;
        --gray-600: #475569;
        --gray-700: #334155;
        --gray-800: #1e293b;
        --gray-900: #0f172a;
        --gradient-primary: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        --gradient-secondary: linear-gradient(135deg, #ec4899 0%, #f43f5e 100%);
        --gradient-success: linear-gradient(135deg, #10b981 0%, #059669 100%);
        --gradient-dark: linear-gradient(135deg, #1e293b 0%, #334155 100%);
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        --border-radius: 12px;
        --border-radius-lg: 16px;
        --border-radius-xl: 24px;
    }

    .footer-links,
    .social-bottom ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li a {
        color: var(--gray-400);
        transition: all 0.3s ease;
        padding: 4px 0;
        display: block;
        border-radius: 4px;
    }

    .footer-links li a:hover {
        color: var(--primary-light);
        transform: translateX(4px);
    }

    .footer-links li {
        margin-bottom: 8px;
    }

    .social-bottom ul {
        display: flex;
        flex-direction: row;
        gap: 12px;
    }

    .social-bottom ul li a {
        color: var(--gray-400);
        font-size: 24px;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .social-bottom ul li a:hover {
        color: #fff;
        background: var(--gradient-primary);
        transform: translateY(-4px);
        box-shadow: var(--shadow-lg);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    /* Ensure footer text has proper contrast */
    .footer h5, .footer h4 {
        color: #fff !important;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    }

    .footer p, .footer td {
        color: var(--gray-300) !important;
    }

    /* Fix footer stats table */
    .footer .textwidget {
        background: rgba(255, 255, 255, 0.1);
        border-radius: var(--border-radius);
        padding: 16px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
</style>
<footer class="footer" style="background: var(--gradient-dark); color: var(--gray-300); padding: 60px 0 20px; position: relative; overflow: hidden; border-top: 4px solid var(--primary-color);">
    <div class="container-fluid">
        <div class="row mb-0">
            <div class="col-md-4">
                <div class="mb-4">
                    <img src="{{ asset('assets/images/landing/logo-light.png') }}" alt="" height="45" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));">
                    <p class="mt-3" style="line-height: 1.6; color: var(--gray-400);">Terwujudnya Kota Banjarbaru sebagai Kota empat dimensi mandiri dan terdepan.
                        Terciptanya kepastian hukum/jaminan hukum, perlindungan hukum serta ketertiban hukum dan
                        tegaknya supremasi hukum. Terciptanya masyarakat, aman damai dan sejahtera. </p>
                </div>
            </div>
            <div class="col-md-2">
                <h5 class="text translate text-white f-17 mb-3" style="position: relative; padding-bottom: 10px;">Tentang Kami</h5>
                <ul class="footer-links mb-0">
                    <li><a href="/sejarah" target="_blank">Sejarah JDIH</a></li>
                    <li><a href="/visi-misi" target="_blank">Visi Misi</a></li>
                    <li><a href="/makna-logo" target="_blank">Makna Logo</a></li>
                    <li><a href="/susunan-organisasi" target="_blank">Sususnan Organisasi</a></li>
                    <li><a href="/tim-pengelola" target="_blank">Tim Pengelola</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h5 class="text translate text-white f-17 mb-3" style="position: relative; padding-bottom: 10px;">Produk Hukum</h5>
                <ul class="footer-links mb-0">
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
                <h4 class="text translate mb-3" style="color: var(--gray-200); position: relative; padding-bottom: 10px;">Statistik Pengunjung</h4>
                <div class="textwidget" style="background: rgba(255, 255, 255, 0.05); border-radius: var(--border-radius); padding: 16px; backdrop-filter: blur(10px);">
                    <table style="width: 100%;">
                        <tbody>
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                                <td style="padding: 8px 0;"><span class="ti-eye" style="margin-right:10px; color: var(--primary-light);"></span></td>
                                <td style="width:110px; padding: 8px 0; color: var(--gray-400);">Views</td>
                                <td style="padding: 8px 0; color: var(--gray-200); font-weight: 600;">{{ $stats->pageviews->value ?? 14.420 }}</td>
                            </tr>
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                                <td style="padding: 8px 0;"><span class="ti-eye" style="margin-right:10px; color: var(--success-color);"></span></td>
                                <td style="width:110px; padding: 8px 0; color: var(--gray-400);">Views Today</td>
                                <td style="padding: 8px 0; color: var(--gray-200); font-weight: 600;">{{ $stats->pageviews->value ?? 13 }}</td>
                            </tr>
                            <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                                <td style="padding: 8px 0;"><span class="ti-user" style="margin-right:10px; color: var(--info-color);"></span></td>
                                <td style="padding: 8px 0; color: var(--gray-400);">Visitor</td>
                                <td style="padding: 8px 0; color: var(--gray-200); font-weight: 600;">{{ $stats->uniques->value ?? 6.419 }}</td>
                            </tr>
                            <tr>
                                <td style="padding: 8px 0;"><span class="ti-user" style="margin-right:10px; color: var(--warning-color);"></span></td>
                                <td style="padding: 8px 0; color: var(--gray-400);">Visitor Today</td>
                                <td style="padding: 8px 0; color: var(--gray-200); font-weight: 600;">{{ $stats->uniques->value ?? 7 }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2">
                <h5 class="text translate text-white f-17 mb-3" style="position: relative; padding-bottom: 10px;">Sosial Media</h5>
                <p style="color: var(--gray-400); margin-bottom: 16px;">Tetap terhubung dengan kami, lihat aktifitas dan update terbaru</p>
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

        <div class="row mt-4 pt-4" style="border-top: 1px solid rgba(255,255,255,0.1);">
            <div class="col-lg-12">
                <div class="text-center">
                    <p class="mb-0" style="color: var(--gray-500);">2024 © Kota Banjarbaru. All rights reserved.</p>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- container-fluid -->

    <!-- Decorative elements -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; overflow: hidden;">
        <div style="position: absolute; top: -50%; right: -10%; width: 400px; height: 400px; background: radial-gradient(circle, rgba(99,102,241,0.1) 0%, transparent 70%); border-radius: 50%;"></div>
        <div style="position: absolute; bottom: -30%; left: -5%; width: 300px; height: 300px; background: radial-gradient(circle, rgba(139,92,246,0.1) 0%, transparent 70%); border-radius: 50%;"></div>
    </div>
</footer>
<!-- footer end -->
