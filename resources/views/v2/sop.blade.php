@extends('layouts.basecoat.layout')

@section('title', 'Sop')

@section('content')
    <header class="flex flex-col gap-3 items-center">
        <h1 class="font-bold text-3xl">SOP</h1>
        <p class="text-muted text-lg">SOP oleh JDIH Banjarbaru</p>
        <form action="/sop" method="GET" class="mt-6 flex gap-3 w-full">
            <label for="query" class="hidden">Cari:</label>
            <input type="search" name="query" id="query" class="input bg-background" placeholder="Cari SOP..."
                value="{{ request('query') }}">
            <button type="submit" class="btn-primary">Cari</button>
        </form>
    </header>

    <section id="sop-list" class="grid grid-cols-1 md:!grid-cols-2 lg:!grid-cols-3 gap-4 my-6">
        @forelse ($sops as $sop)
            <div class="card hover:cursor-pointer hover:shadow-lg transition-all duration-300"
                onclick="document.getElementById('iframe-{{$sop->id}}').requestFullscreen()">
                <header>
                    <time class="text-muted-foreground text-sm">{{ $sop->created_at }}</time>
                    <h2>{{ $sop->nama }}</h2>
                    <p>{{ $sop->deskripsi ?? '-' }}</p>
                </header>

                <iframe id="iframe-{{$sop->id}}" src="{{ asset('storage' . $sop->file_path) }}" frameborder="0" width="100%"
                    height="100%" class="mx-auto" allowfullscreen />
            </div>
        @empty
            <div class="card col-span-3">
                <div class="card-body">
                    <p class="text-center text-muted-foreground">Belum ada SOP</p>
                </div>
            </div>
        @endforelse
    </section>
@endsection
