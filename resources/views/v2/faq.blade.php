@extends('layouts.basecoat.layout')

@section('title', 'FAQ')

@section('content')
    <header class="flex flex-col gap-3 items-center">
        <h1 class="font-bold text-3xl">Pertanyaan yang sering diajukan</h1>
        <p class="text-muted text-lg">Temukan jawaban atas pertanyaan umum tentang JDIH Banjarbaru</p>
        <form action="/faq" method="GET" class="mt-6 flex gap-3 w-full">
            <label for="query" class="hidden">Cari:</label>
            <input type="search" name="query" id="query" class="input bg-background" placeholder="Cari..."
                value="{{ request('query') }}">
            <button type="submit" class="btn-primary">Cari</button>
        </form>
    </header>

    <section id="faq-list" class="card my-6">
        <section class="accordion">
            @forelse ($faqs as $faq)
                <details class="group border-b last:border-b-0">
                    <summary
                        class="w-full focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] transition-all outline-none rounded-md">
                        <h2
                            class="flex flex-1 items-start justify-between gap-4 py-4 text-left text-sm font-medium hover:underline">
                            {{ $faq->pertanyaan }}
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="text-muted-foreground pointer-events-none size-4 shrink-0 translate-y-0.5 transition-transform duration-200 group-open:rotate-180">
                                <path d="m6 9 6 6 6-6" />
                            </svg>
                        </h2>
                    </summary>
                    <section class="pb-4">
                        <p class="text-sm text-muted">
                            {!! $faq->jawaban !!}
                        </p>
                    </section>
                </details>
            @empty
                <div class="flex flex-col items-center gap-4 py-8">
                    <div class="w-20 h-20">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 88 88">
                            <path
                                d="m86.69 32.608-8.65-4.868 8.65-4.868a1 1 0 0 0 0-1.744l-32-18a1.002 1.002 0 0 0-.98 0L44 8.593l-9.71-5.465a1.002 1.002 0 0 0-.98 0l-32 18a1 1 0 0 0 0 1.744l8.65 4.868-8.65 4.868a1 1 0 0 0 0 1.744l9.69 5.45V66a1.001 1.001 0 0 0 .51.872l32 18A1.203 1.203 0 0 0 44 85a1.232 1.232 0 0 0 .49-.128l32-18A1.001 1.001 0 0 0 77 66V39.802l9.69-5.45a1 1 0 0 0 0-1.744zM43 44.03 14.04 27.74 43 11.45zm2-32.58 28.96 16.29L45 44.03zm9.2-6.303L84.161 22 76 26.593 46.04 9.74zm-20.4 0 8.16 4.593-22.47 12.64L12 26.593 3.839 22zM12 28.887 41.96 45.74l-8.16 4.593L3.839 33.48zm1 12.042 20.31 11.423a1 1 0 0 0 .98 0L43 47.45v34.84L13 65.415zm62 0v24.486L45 82.29V47.45l8.71 4.901a1 1 0 0 0 .98 0zm-20.8 9.404-8.16-4.593L76 28.888l8.161 4.592z"
                                style="fill:#1d1b1e" data-name="Unbox" />
                        </svg>
                    </div>
                    <p class="text-center text-muted-foreground">Belum ada pertanyaan ditemukan</p>
                </div>
            @endforelse

            {{-- <details open class="group border-b last:border-b-0">
                <summary
                    class="w-full focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] transition-all outline-none rounded-md">
                    <h2
                        class="flex flex-1 items-start justify-between gap-4 py-4 text-left text-sm font-medium hover:underline">
                        Apa itu JDIH Kota Banjarbaru?
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="text-muted-foreground pointer-events-none size-4 shrink-0 translate-y-0.5 transition-transform duration-200 group-open:rotate-180">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </h2>
                </summary>
                <section class="pb-4">
                    <p class="text-sm text-muted">
                        JDIH (Jaringan Dokumentasi dan Informasi Hukum) Kota Banjarbaru adalah sistem yang
                        menyediakan akses terhadap dokumentasi dan informasi hukum di wilayah Kota Banjarbaru.
                        Sistem ini dikelola oleh Bagian Hukum Sekretariat Daerah Kota Banjarbaru dan bertujuan untuk
                        memudahkan masyarakat dalam mengakses berbagai produk hukum daerah.
                    </p>
                </section>
            </details>
            <details class="group border-b last:border-b-0">
                <summary
                    class="w-full focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] transition-all outline-none rounded-md">
                    <h2
                        class="flex flex-1 items-start justify-between gap-4 py-4 text-left text-sm font-medium hover:underline">
                        Bagaimana cara mengakses produk hukum di JDIH?
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="text-muted-foreground pointer-events-none size-4 shrink-0 translate-y-0.5 transition-transform duration-200 group-open:rotate-180">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </h2>
                </summary>
                <section class="pb-4">
                    <p class="text-sm">Yes. It comes with default styles that matches the other components'
                        aesthetic.</p>
                </section>
            </details>
            <details class="group border-b last:border-b-0">
                <summary
                    class="w-full focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] transition-all outline-none rounded-md">
                    <h2
                        class="flex flex-1 items-start justify-between gap-4 py-4 text-left text-sm font-medium hover:underline">
                        Jenis produk hukum apa saja yang tersedia di JDIH?
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="text-muted-foreground pointer-events-none size-4 shrink-0 translate-y-0.5 transition-transform duration-200 group-open:rotate-180">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                    </h2>
                </summary>
                <section>
                    <p class="text-sm whitespace-pre-wrap">Yes. It's animated by default, but you can disable it if
                        you prefer.</p>
                </section>
            </details> --}}
        </section>
        <script>
            (() => {
                const accordions = document.querySelectorAll(".accordion");
                accordions.forEach((accordion) => {
                    accordion.addEventListener("click", (event) => {
                        const summary = event.target.closest("summary");
                        if (!summary) return;
                        const details = summary.closest("details");
                        if (!details) return;
                        accordion.querySelectorAll("details").forEach((detailsEl) => {
                            if (detailsEl !== details) {
                                detailsEl.removeAttribute("open");
                            }
                        });
                    });
                });
            })();
        </script>

    </section>
@endsection
