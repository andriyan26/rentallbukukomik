@extends('layouts.app')

@section('title', 'Kategori Komik')

@section('content')
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6 mb-10">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-white/50">Eksplorasi</p>
            <h1 class="text-4xl font-bold text-white">Kategori Komik</h1>
            <p class="mt-2 text-white/70 max-w-2xl">Pilih kategori favorit untuk langsung diarahkan ke daftar buku dengan filter yang sesuai.</p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($categories as $category)
            <div class="rounded-[28px] border border-white/10 bg-white/5 backdrop-blur-2xl p-6 flex flex-col gap-4 shadow-xl">
                <div class="text-xs uppercase tracking-[0.5em] text-white/60">Kategori</div>
                <h2 class="text-2xl font-semibold text-white">{{ $category->name }}</h2>
                <p class="text-white/70 text-sm leading-relaxed">{{ $category->description }}</p>
                <div class="flex items-center justify-between text-white/70 text-sm pt-2 border-t border-white/10">
                    <span>{{ $category->comics_count }} judul tersedia</span>
                    <a href="{{ route('catalog', ['category' => $category->slug]) }}" class="px-4 py-2 rounded-full bg-gradient-to-r from-aurora to-lilac text-midnight text-sm font-semibold drop-shadow-neon">Lihat Buku</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection