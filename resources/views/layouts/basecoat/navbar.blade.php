<nav class="bg-background text-foreground h-20 flex items-center border-b px-4 md:px-6 sticky top-0">
    <div class="max-w-7xl mx-auto w-full flex items-center px-4 lg:px-6">
        <a href="{{ route('index') }}" class="flex gap-3 items-center -ml-3 sm:ml-0">
            <img src="{{ asset('assets/images/logo.png') }}" alt="JDIH Logo" class="h-8 lg:!h-10 object-cover" />
        </a>

        <div class="ml-auto">
            <menu class="hidden lg:!flex gap-1 items-center">
                <li>
                    <a class="{{ request()->is('v2') ? 'btn-secondary' : 'btn-ghost' }}"
                        href="{{ request()->is('v2') ? route('v2.landing-page') : route('index') }}">
                        Beranda
                    </a>
                </li>

                {{-- <a href="javascript:void(0);" class="nav-link">{{ translateIt('Profil') }}</a>
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
                        <a href="/perwalipengelola" class="nav-link">{{ translateIt('Perwali Pengelolaan JDIH') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="/susunan-organisasi" class="nav-link">{{ translateIt('Susunan Organisasi') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="/sop" class="nav-link">{{ translateIt('SOP') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="/pustaka" class="nav-link">{{ translateIt('Pustaka JDIH') }}</a>
                    </li>
                </ul> --}}


                <li id="demo-dropdown-menu" class="dropdown-menu">
                    <button type="button" id="demo-dropdown-menu-trigger" aria-haspopup="menu"
                        aria-controls="demo-dropdown-menu-menu" aria-expanded="false" class="btn-ghost">
                        {{ translateIt('Profil') }}
                    </button>
                    <div id="demo-dropdown-menu-popover" data-popover aria-hidden="true" class="min-w-56">
                        <div role="menu" id="demo-dropdown-menu-menu" aria-labelledby="demo-dropdown-menu-trigger">
                            <div role="group" aria-labelledby="account-options">
                                <a role="menuitem" href="{{ route('sambutan') }}">
                                    {{ translateIt('Sambutan Kabag. Hukum') }}
                                </a>
                                <a role="menuitem" href="{{ route('visimisi') }}">
                                    {{ translateIt('Visi Misi') }}
                                </a>
                                <a role="menuitem" href="{{ route('makna-logo') }}">
                                    {{ translateIt('Makna Logo') }}
                                </a>
                                <a role="menuitem" href="{{ route('sejarahbjb') }}">
                                    {{ translateIt('Sejarah Banjarbaru') }}
                                </a>
                                <a role="menuitem" href="{{ route('sejarah') }}">
                                    {{ translateIt('Sejarah') }}
                                </a>
                                <a role="menuitem" href="{{ route('tupoksi') }}">
                                    {{ translateIt('Tugas Pokok') }}
                                </a>
                                <a role="menuitem" href="{{ route('tim') }}">
                                    {{ translateIt('Tim Pengelola') }}
                                </a>
                                <a role="menuitem" href="{{ route('sk') }}">
                                    {{ translateIt('SK Tim JDIH') }}
                                </a>
                                <a role="menuitem" href="{{ route('perwalipengelola') }}">
                                    {{ translateIt('Perwali Pengelolaan JDIH') }}
                                </a>
                                <a role="menuitem" href="{{ route('susunanorganisasi') }}">
                                    {{ translateIt('Susunan Organisasi') }}
                                </a>
                                <a role="menuitem" href="{{ route('v2.sop') }}">
                                    {{ translateIt('SOP') }}
                                </a>
                                <a role="menuitem" href="{{ route('v2.galeri') }}">
                                    {{ translateIt('Galeri Foto') }}
                                </a>
                                <a role="menuitem" href="{{ route('pustaka') }}">
                                    {{ translateIt('Pustaka JDIH') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </li>

                <li id="demo-dropdown-menu" class="dropdown-menu">
                    <button type="button" id="demo-dropdown-menu-trigger" aria-haspopup="menu"
                        aria-controls="demo-dropdown-menu-menu" aria-expanded="false" class="btn-ghost">
                        Produk Hukum
                    </button>
                    <div id="demo-dropdown-menu-popover" data-popover aria-hidden="true" class="min-w-56">
                        <div role="menu" id="demo-dropdown-menu-menu" aria-labelledby="demo-dropdown-menu-trigger">
                            <div role="group" aria-labelledby="account-options">
                                <div role="heading" id="account-options">{{translateIt('Peraturan Daerah')}}</div>
                                <div role="menuitem">
                                    Profile
                                    <span class="text-muted-foreground ml-auto text-xs tracking-widest">⇧⌘P</span>
                                </div>
                                <div role="menuitem">
                                    Billing
                                    <span class="text-muted-foreground ml-auto text-xs tracking-widest">⌘B</span>
                                </div>
                                <div role="menuitem">
                                    Settings
                                    <span class="text-muted-foreground ml-auto text-xs tracking-widest">⌘S</span>
                                </div>
                                <div role="menuitem">
                                    Keyboard shortcuts
                                    <span class="text-muted-foreground ml-auto text-xs tracking-widest">⌘K</span>
                                </div>
                            </div>
                            <hr role="separator" />
                            <div role="menuitem">GitHub</div>
                            <div role="menuitem">Support</div>
                            <div role="menuitem" aria-disabled="true">API</div>
                            <hr role="separator" />
                            <div role="menuitem">
                                Logout
                                <span class="text-muted-foreground ml-auto text-xs tracking-widest">⇧⌘P</span>
                            </div>
                        </div>
                    </div>
                </li>

                <li>
                    <a class="{{ request()->is('kontak') ? 'btn-secondary' : 'btn-ghost' }}"
                        href="{{ route('kontak') }}">
                        Kontak
                    </a>
                </li>

                <li>
                    <a class="{{ request()->is('faq') ? 'btn-secondary' : 'btn-ghost' }}" href="{{ route('v2.faq') }}">
                        FAQ
                    </a>
                </li>

                <li>
                    <a class="{{ request()->is('sop') ? 'btn-secondary' : 'btn-ghost' }}" href="{{ route('v2.sop') }}">
                        SOP
                    </a>
                </li>
            </menu>
        </div>
    </div>
</nav>
