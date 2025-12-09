@extends('layouts.app')

@section('title', 'Daftar Buku Komik')

@section('content')
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-white/50">Koleksi Buku Komik</p>
            <h1 class="text-4xl font-bold text-white">Daftar Katalog Lengkap</h1>
        </div>
        <form method="GET" class="flex flex-wrap gap-4 bg-white/5 border border-white/10 backdrop-blur-2xl rounded-2xl p-4">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari judul atau penulis"
                   class="flex-1 min-w-[220px] rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-white placeholder:text-white/40 focus:outline-none focus:ring-2 focus:ring-aurora">
            <select name="category" class="rounded-xl border border-white/10 bg-white/5 px-4 py-2 text-white focus:outline-none focus:ring-2 focus:ring-aurora">
                <option class="text-midnight" value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option class="text-midnight" value="{{ $category->slug }}" @selected(request('category') === $category->slug)>{{ $category->name }}</option>
                @endforeach
            </select>
            <button class="px-6 py-2 rounded-xl bg-gradient-to-r from-aurora to-lilac text-midnight font-semibold drop-shadow-neon">Filter</button>
        </form>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($comics as $comic)
            @php
                $cover = $comic->cover_url;
            @endphp
            <div class="rounded-[28px] border border-white/10 bg-white/5 backdrop-blur-xl flex flex-col shadow-xl overflow-hidden">
                <div class="w-full h-48 bg-white/5 border-b border-white/10 flex items-center justify-center">
                    <img src="{{ $cover }}" alt="Cover {{ $comic->title }}" class="max-h-full max-w-full object-contain" loading="lazy">
                </div>
                <div class="p-6 flex-1 space-y-3">
                    <p class="text-xs uppercase tracking-[0.4em] text-white/50">{{ $comic->category->name }}</p>
                    <h2 class="text-2xl font-semibold text-white">{{ $comic->title }}</h2>
                    <p class="text-white/60 text-sm">{{ $comic->author }} • {{ $comic->release_year }}</p>
                    <p class="text-3xl font-bold text-aurora">Rp{{ number_format($comic->daily_price, 0, ',', '.') }}<span class="text-sm text-white/60"> / hari</span></p>
                    <p class="text-white/60 text-sm">{{ $comic->stock }} stok tersedia</p>
                </div>
                <div class="p-6 border-t border-white/10 flex gap-3">
                    <a href="{{ route('catalog.show', $comic) }}" class="flex-1 text-center px-4 py-2 rounded-xl border border-white/20 text-white font-semibold">Detail</a>
                    @php
                        $rentLink = auth()->check() && auth()->user()->role === 'member'
                            ? route('rentals.create', ['comic_id' => $comic->id])
                            : route('login');
                    @endphp
                    <a href="{{ $rentLink }}" class="flex-1 text-center px-4 py-2 rounded-xl bg-gradient-to-r from-gold to-aurora text-midnight font-semibold drop-shadow-neon">Sewa</a>
                </div>
            </div>
        @empty
            <p class="text-white/60">Belum ada komik yang sesuai filter.</p>
        @endforelse
    </div>

    <div class="mt-10 text-white/60">
        {{ $comics->links() }}
    </div>
@endsection

