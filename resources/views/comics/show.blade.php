@extends('layouts.app')

@section('title', $comic->title)

@section('content')
    <div class="grid md:grid-cols-3 gap-10">
        <div class="md:col-span-2 rounded-[32px] border border-white/10 bg-white/5 backdrop-blur-2xl p-10 space-y-6">
            <div class="w-full h-72 bg-white/5 rounded-3xl border border-white/10 flex items-center justify-center">
                <img src="{{ $comic->cover_url }}" alt="Cover {{ $comic->title }}" class="max-h-full max-w-full object-contain" loading="lazy">
            </div>
            <p class="text-sm uppercase tracking-[0.4em] text-aurora">{{ $comic->category->name }}</p>
            <h1 class="text-4xl font-bold text-white mt-4">{{ $comic->title }}</h1>
            <p class="mt-2 text-white/70">{{ $comic->author }} | {{ $comic->publisher }} | {{ $comic->release_year }}</p>
            <p class="mt-6 text-white/80 leading-relaxed">{{ $comic->synopsis }}</p>
        </div>
        <div class="rounded-[32px] border border-white/10 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-2xl p-10">
            <p class="text-sm text-white/60">Harga Sewa</p>
            <p class="text-4xl font-bold text-aurora mt-1">Rp{{ number_format($comic->daily_price, 0, ',', '.') }}<span class="text-base text-white/50 font-medium"> / hari</span></p>
            <p class="mt-4 text-white/70">{{ $comic->stock }} stok tersisa</p>
            <div class="mt-8 space-y-4">
                @php
                    $rentLink = auth()->check() && auth()->user()->role === 'member'
                        ? route('rentals.create', ['comic_id' => $comic->id])
                        : route('login');
                @endphp
                <a href="{{ $rentLink }}" class="block text-center w-full px-5 py-3 rounded-full bg-gradient-to-r from-gold to-aurora text-midnight font-semibold drop-shadow-neon">Sewa Sekarang</a>
                <a href="{{ route('catalog') }}" class="block text-center w-full px-5 py-3 rounded-full border border-white/20 text-white font-semibold">Kembali ke Daftar</a>
            </div>
        </div>
    </div>

    <section class="mt-14">
        <h2 class="text-3xl font-semibold text-white mb-6">Rekomendasi lainnya</h2>
        <div class="grid md:grid-cols-4 gap-6">
            @foreach($related as $item)
                <a href="{{ route('catalog.show', $item) }}" class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-5 hover:border-aurora/50 transition space-y-3">
                    <div class="w-full h-40 bg-white/5 rounded-2xl border border-white/10 flex items-center justify-center">
                        <img src="{{ $item->cover_url }}" alt="Cover {{ $item->title }}" class="max-h-full max-w-full object-contain" loading="lazy">
                    </div>
                    <p class="text-sm text-white/60">{{ $item->category->name }}</p>
                    <p class="text-lg font-semibold text-white mt-1">{{ $item->title }}</p>
                    <p class="text-sm text-white/60">{{ $item->author }}</p>
                </a>
            @endforeach
        </div>
    </section>
@endsection

