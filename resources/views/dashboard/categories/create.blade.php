@extends('layouts.dashboard')

@section('title', 'Tambah Kategori')

@section('content')
    <h1 class="text-3xl font-bold text-white mb-6">Tambah Kategori Baru</h1>
    <form method="POST" action="{{ route('dashboard.categories.store') }}" class="rounded-[32px] border border-white/10 bg-white/5 backdrop-blur-2xl p-8 space-y-5 text-white">
        @csrf
        <div>
            <label class="block text-sm font-semibold text-white/70 mb-2">Nama kategori</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
        </div>
        <div>
            <label class="block text-sm font-semibold text-white/70 mb-2">Ikon (opsional)</label>
            <input type="text" name="icon" value="{{ old('icon') }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
        </div>
        <div>
            <label class="block text-sm font-semibold text-white/70 mb-2">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">{{ old('description') }}</textarea>
        </div>
        <div class="flex justify-end gap-4">
            <a href="{{ route('dashboard.categories.index') }}" class="px-5 py-3 rounded-full border border-white/20 text-white font-semibold hover:bg-white/10 transition duration-200">Batal</a>
            <button type="submit" class="px-6 py-3 rounded-full bg-gradient-to-r from-gold to-aurora text-white font-semibold drop-shadow-neon hover:bg-aurora transition-colors duration-300">Simpan</button>
        </div>
    </form>
@endsection
