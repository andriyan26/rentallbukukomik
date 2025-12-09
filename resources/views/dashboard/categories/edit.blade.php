@extends('layouts.dashboard')

@section('title', 'Edit Kategori')

@section('content')
    <h1 class="text-3xl font-bold text-white mb-6">Edit Kategori</h1>
    <form method="POST" action="{{ route('dashboard.categories.update', $category) }}" class="rounded-[32px] border border-white/10 bg-white/5 backdrop-blur-2xl p-8 space-y-5 text-white">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-semibold text-white/70 mb-2">Nama kategori</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
        </div>
        <div>
            <label class="block text-sm font-semibold text-white/70 mb-2">Ikon (opsional)</label>
            <input type="text" name="icon" value="{{ old('icon', $category->icon) }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
        </div>
        <div>
            <label class="block text-sm font-semibold text-white/70 mb-2">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">{{ old('description', $category->description) }}</textarea>
        </div>
        <div class="flex justify-end gap-4">
            <a href="{{ route('dashboard.categories.index') }}" class="px-5 py-3 rounded-full border border-white/20 text-white font-semibold">Batal</a>
            <button class="px-5 py-3 rounded-full bg-gradient-to-r from-gold to-aurora text-white font-semibold drop-shadow-neon">Update</button>
        </div>
    </form>
@endsection

