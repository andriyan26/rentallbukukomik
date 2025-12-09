@extends('layouts.dashboard')

@section('title', 'Edit Komik')

@section('content')
    <h1 class="text-3xl font-bold text-white mb-6">Edit Komik</h1>
    <form method="POST" action="{{ route('dashboard.comics.update', $comic) }}" enctype="multipart/form-data" class="rounded-[32px] border border-white/10 bg-white/5 backdrop-blur-2xl p-8 space-y-5 text-white">
        @csrf
        @method('PUT')
        @include('dashboard.comics.partials.form', ['comic' => $comic])
        <div class="flex justify-end gap-4">
            <a href="{{ route('dashboard.comics.index') }}" class="px-5 py-3 rounded-full border border-white/20 text-white font-semibold">Batal</a>
            <button class="px-5 py-3 rounded-full bg-gradient-to-r from-gold to-aurora text-white font-semibold drop-shadow-neon">Update</button>
        </div>
    </form>
@endsection

