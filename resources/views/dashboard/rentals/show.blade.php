@extends('layouts.dashboard')

@section('title', 'Detail Penyewaan')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-white/50">Transaksi</p>
            <h1 class="text-3xl font-bold text-white">Detail Penyewaan {{ $rental->rental_code }}</h1>
        </div>
        <a href="{{ route('dashboard.rentals.index') }}" class="px-4 py-2 rounded-full border border-white/20 text-white font-semibold">Kembali</a>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6 space-y-4">
            <h2 class="text-xl font-semibold text-white">Informasi Peminjam</h2>
            <p class="text-white font-semibold">{{ $rental->user->name ?? 'Pengguna dihapus' }}</p>
            <p class="text-white/70">{{ $rental->user->email ?? '-' }}</p>
            <p class="text-white/70">{{ $rental->user->phone ?? '-' }}</p>
            <p class="text-white/70">{{ $rental->user->address ?? '-' }}</p>
            <p class="text-white/60">Periode: {{ $rental->start_date->format('d M Y') }} - {{ $rental->end_date->format('d M Y') }} ({{ $rental->rental_days }} hari)</p>
        </div>
        <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6 space-y-4">
            <h2 class="text-xl font-semibold text-white">Update Status</h2>
            <form method="POST" action="{{ route('dashboard.rentals.update', $rental) }}" class="space-y-4 text-white">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-sm font-semibold text-white/70 mb-2">Status</label>
                    <select name="status" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
                        @foreach(['pending','confirmed','ongoing','completed','cancelled','overdue'] as $status)
                            <option class="text-midnight" value="{{ $status }}" @selected($rental->status === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-white/70 mb-2">Catatan</label>
                    <textarea name="notes" rows="3" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">{{ old('notes', $rental->notes) }}</textarea>
                </div>
                <button class="px-5 py-3 rounded-full bg-gradient-to-r from-gold to-aurora text-white font-semibold drop-shadow-neon">Simpan Perubahan</button>
            </form>
        </div>
    </div>

    <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-2xl p-6 mt-10">
        <h2 class="text-xl font-semibold text-white mb-4">Detail Buku</h2>
        <table class="min-w-full divide-y divide-white/10 text-sm text-white/80">
            <thead class="bg-white/5 text-white/60 uppercase tracking-[0.4em]">
                <tr>
                    <th class="px-4 py-3 text-left">Komik</th>
                    <th class="px-4 py-3 text-left">Qty</th>
                    <th class="px-4 py-3 text-left">Durasi</th>
                    <th class="px-4 py-3 text-left">Subtotal</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/10">
                @foreach($rental->items as $item)
                    <tr>
                        <td class="px-4 py-3 text-white">{{ $item->comic->title ?? 'Komik dihapus' }}</td>
                        <td class="px-4 py-3">{{ $item->quantity }}</td>
                        <td class="px-4 py-3">{{ $item->duration_days }} hari</td>
                        <td class="px-4 py-3 font-semibold text-aurora">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="px-4 py-4 text-right font-semibold text-white/70">Total</td>
                    <td class="px-4 py-4 text-xl font-bold text-aurora">Rp{{ number_format($rental->total_price, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection

