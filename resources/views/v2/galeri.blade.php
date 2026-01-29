@extends('layouts.basecoat.layout')

@section('title', 'Galeri')

@section('content')
    <header class="flex flex-col gap-3 items-center">
        <h1 class="font-bold text-3xl">Galeri Foto</h1>
        <p class="text-muted text-lg">Foto-foto kegiatan oleh JDIH Banjarbaru</p>
        <form action="/galeri" method="GET" class="mt-6 flex gap-3 w-full">
            <label for="query" class="hidden">Cari:</label>
            <input type="search" name="query" id="query" class="input bg-background" placeholder="Cari nama kegiatan..."
                value="{{ request('query') }}">
            <button type="submit" class="btn-primary">Cari</button>
        </form>
    </header>

    <section id="galeri-list" class="grid grid-cols-1 md:!grid-cols-2 lg:!grid-cols-3 gap-4 my-6">
        @forelse ($galeris as $galeri)
            {{-- <div class="card hover:cursor-pointer hover:shadow-lg transition-all duration-300"
                onclick="document.getElementById('dialog-{{$galeri->nama_kegiatan}}').showModal()">
                <header>
                    <h2>{{ $galeri->nama_kegiatan }}</h2>
                    <p>{{ $galeri->created_at }}</p>
                </header>
                <section class="px-0" class="h-[240px] w-[320px]">
                    <img alt="" loading="lazy" class="object-cover h-full w-full" style="color:transparent"
                        src="{{ asset('storage/' . $galeri->foto_kegiatan[0]) }}" />
                </section>
            </div> --}}

            <div class="relative w-full flex items-end justify-start text-left bg-cover bg-center hover:cursor-pointer hover:shadow transition-all duration-300"
                style="height: 450px; background-image:url({{ isset($galeri->foto_kegiatan) && is_array($galeri->foto_kegiatan) && count($galeri->foto_kegiatan) > 0 ? asset('storage' . $galeri->foto_kegiatan[0]) : asset('assets/images/placeholder.jpg') }});"
                onclick="document.getElementById('dialog-{{$galeri->nama_kegiatan}}').showModal()">
                <div class="absolute top-0 mt-20 right-0 bottom-0 left-0 bg-gradient-to-b from-transparent to-gray-900">
                </div>
                <div class="absolute top-0 right-0 left-0 mx-5 mt-2 flex justify-between items-center">
                    <a href="#"
                        class="text-xs bg-indigo-600 text-white px-5 py-2 uppercase hover:bg-white hover:text-indigo-600 transition ease-in-out duration-500">Kegiatan</a>
                    <div class="text-white font-regular flex flex-col justify-start">

                        <span class="text-3xl font-semibold">{{$galeri->created_at->format('d')}}</span>
                        <span class="">{{$galeri->created_at->format('M')}}</span>
                    </div>
                </div>
                <main class="p-5 z-10">
                    <a class="text-md tracking-tight font-medium leading-7 font-regular text-white hover:underline">
                        {{$galeri->nama_kegiatan}}
                    </a>
                </main>
            </div>

            <dialog id="dialog-{{$galeri->nama_kegiatan}}" class="dialog w-full sm:!max-w-[800px] max-h-[612px]"
                onclick="this.close()">
                <article class="max-w-[90%] mx-auto" onclick="event.stopPropagation()">
                    <header>
                        <h2>{{ $galeri->nama_kegiatan }}</h2>
                        <p>{{ $galeri->created_at }}</p>
                    </header>

                    <section class="overflow-y-auto scrollbar">
                        <div class="space-y-4 grid grid-cols-1 md:!grid-cols-2 gap-4 p-4">
                            @if(isset($galeri->foto_kegiatan) && is_array($galeri->foto_kegiatan))
                                @foreach ($galeri->foto_kegiatan as $foto)
                                    <div class="h-auto shadow">
                                        <img src="{{ asset('storage' . $foto) }}" alt="{{ $galeri->nama_kegiatan }}" loading="lazy" class="w-full h-full">
                                    </div>
                                @endforeach
                            @else
                                <div class="col-span-2 text-center text-muted-foreground">
                                    <p>Tidak ada foto tersedia</p>
                                </div>
                            @endif
                        </div>
                    </section>

                    <footer>
                        <button class="btn-outline" onclick="this.closest('dialog').close()">Tutup</button>
                    </footer>

                    <form method="dialog">
                        <button aria-label="Close dialog">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="lucide lucide-x-icon lucide-x">
                                <path d="M18 6 6 18" />
                                <path d="m6 6 12 12" />
                            </svg>
                        </button>
                    </form>
                </article>
            </dialog>
        @empty
            <div class="card col-span-3">
                <div class="card-body">
                    <p class="text-center text-muted-foreground">Belum ada galeri</p>
                </div>
            </div>
        @endforelse
    </section>
@endsection
