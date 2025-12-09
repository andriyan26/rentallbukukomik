@extends('layouts.dashboard')

@section('title', 'Tambah Komik')

@section('content')
    <h1 class="text-3xl font-bold text-white mb-6">Tambah Komik Baru</h1>
    <form method="POST" action="{{ route('dashboard.comics.store') }}" enctype="multipart/form-data" class="rounded-[32px] border border-white/10 bg-white/5 backdrop-blur-2xl p-8 space-y-5 text-white">
        @csrf
        @include('dashboard.comics.partials.form', ['comic' => null])
        <div class="flex justify-end gap-4">
            <a href="{{ route('dashboard.comics.index') }}" class="px-5 py-3 rounded-full border border-white/20 text-white font-semibold">Batal</a>
            <button class="px-5 py-3 rounded-full bg-gradient-to-r from-gold to-aurora text-white font-semibold drop-shadow-neon">Simpan</button>
        </div>
    </form>
@endsection

