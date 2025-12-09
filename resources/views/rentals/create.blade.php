@extends('layouts.app')

@section('title', 'Form Penyewaan')

@section('content')
    <div class="max-w-3xl mx-auto rounded-[32px] border border-white/10 bg-white/5 backdrop-blur-2xl p-10 shadow-2xl">
        <h1 class="text-4xl font-bold text-white mb-8">Form Penyewaan Komik</h1>
        <form method="POST" action="{{ route('rentals.store') }}" class="space-y-6 text-white">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-white/70 mb-2">Pilih Komik</label>
                <select name="comic_id" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-aurora">
                    <option class="text-midnight" value="">-- pilih komik --</option>
                    @foreach($comics as $comic)
                        <option class="text-midnight" value="{{ $comic->id }}" @selected(old('comic_id', request('comic_id')) == $comic->id)>
                            {{ $comic->title }} (Stok: {{ $comic->stock }}) - Rp{{ number_format($comic->daily_price, 0, ',', '.') }}/hari
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-white/70 mb-2">Jumlah buku</label>
                    <input type="number" min="1" name="quantity" value="{{ old('quantity', 1) }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-white/70 mb-2">Tanggal mulai</label>
                    <input type="date" name="start_date" value="{{ old('start_date', now()->format('Y-m-d')) }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-white/70 mb-2">Tanggal selesai</label>
                    <input type="date" name="end_date" value="{{ old('end_date', now()->addDays(3)->format('Y-m-d')) }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
                </div>
            </div>
            <div class="flex justify-end gap-4">
                <a href="{{ route('rentals.index') }}" class="px-5 py-3 rounded-full border border-white/20 text-white font-semibold">Batal</a>
                <button class="px-5 py-3 rounded-full bg-gradient-to-r from-gold to-aurora text-midnight font-semibold drop-shadow-neon">Kirim Permintaan</button>
            </div>
        </form>
    </div>
@endsection

