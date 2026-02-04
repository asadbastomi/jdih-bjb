<!-- ========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ asset('assets/images/users/user-1.jpg') }}" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-toggle="dropdown">Admin</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user mr-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings mr-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    {{-- <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock mr-1"></i>
                        <span>Lock Screen</span>
                    </a> --}}

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out mr-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>

                <li>
                    <a href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-monitor-dashboard"></i>
                        <span class="badge badge-success badge-pill float-right"></span>
                        <span> Dashboards </span>
                    </a>
                </li>
                <li>
                    <a href="#sidebarDashboards" data-toggle="collapse">
                        <i class="mdi mdi-locker-multiple"></i>
                        <span class="badge badge-success badge-pill float-right"></span>
                        <span> Management </span>
                    </a>
                    <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{ route('admin.roles.index') }}">Role</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.users.index') }}">Users</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title mt-2">Feature</li>

                <li>
                    <a href="{{ route('admin.halaman.index') }}">
                        <i class="mdi mdi-post"></i>
                        <span> Pages </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.slide.index') }}">
                        <i class="mdi mdi-view-carousel"></i>
                        <span> Slideshow </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.jadwal.index') }}">
                        <i class="mdi mdi-calendar-range"></i>
                        <span> Jadwal </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kegiatan.index') }}">
                        <i class="mdi mdi-post-outline"></i>
                        <span> Posts </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.artikel.index') }}">
                        <i class="mdi mdi-newspaper-variant-outline"></i>
                        <span> Artikel </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kategori.index') }}">
                        <i class="mdi mdi-dip-switch"></i>
                        <span> Categories </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.tema-dokumen.index') }}">
                        <i class="mdi mdi-tag-multiple"></i>
                        <span> Tema Dokumen </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.perda.index') }}">
                        <i class="mdi mdi-book-open-page-variant"></i>
                        <span> Perda </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.perwal.index') }}">
                        <i class="mdi mdi-book-open-page-variant"></i>
                        <span> Perwal </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kep-walikota.index') }}">
                        <i class="mdi mdi-book-open-page-variant"></i>
                        <span> Keputusan Wali Kota </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.putusan.index') }}">
                        <i class="mdi mdi-book-open-page-variant"></i>
                        <span> Putusan </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.propemperda.index') }}">
                        <i class="mdi mdi-book-open-variant"></i>
                        <span> Propemperda </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.buku.index') }}">
                        <i class="mdi mdi-bookshelf"></i>
                        <span> Monografi </span>
                    </a>
                </li>
                {{-- <li>
                    <a href="/dashboard/penghargaan">
                        <i class="mdi mdi-trophy"></i>
                        <span> Penghargaan </span>
                    </a>
                </li> --}}
                {{-- <li>
                    <a href="/dashboard/relaas">
                        <i class="mdi mdi-bullhorn"></i>
                        <span> Relaas </span>
                    </a>
                </li> --}}
                <li>
                    <a href="/dashboard/relaas-v2">
                        <i class="mdi mdi-bullhorn"></i>
                        <span> Relaas </span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/buku-tamu">
                        <i class="mdi mdi-book-account"></i>
                        <span> Buku Tamu </span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/faq">
                        <i class="mdi mdi-frequently-asked-questions"></i>
                        <span> FAQ </span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/galeri">
                        <i class="mdi mdi-image-album"></i>
                        <span> Galeri </span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/penghargaan-v2">
                        <i class="mdi mdi-trophy"></i>
                        <span> Penghargaan </span>
                    </a>
                </li>
                <li>
                    <a href="/dashboard/sop">
                        <i class="mdi mdi-file-check"></i>
                        <span> SOP </span>
                    </a>
                </li>

            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End -->
