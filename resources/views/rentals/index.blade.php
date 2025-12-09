@extends('layouts.app')

@section('title', 'Riwayat Sewa')

@section('content')
    <div class="flex items-center justify-between mb-10">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-white/50">Sewa Buku</p>
            <h1 class="text-4xl font-bold text-white">Riwayat Penyewaan</h1>
        </div>
        <a href="{{ route('rentals.create') }}" class="px-5 py-3 rounded-full bg-gradient-to-r from-aurora to-lilac text-midnight font-semibold drop-shadow-neon">Buat Sewa Baru</a>
    </div>

    <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-2xl overflow-hidden">
        <table class="min-w-full divide-y divide-white/10 text-sm text-white/80">
            <thead class="bg-white/5 uppercase tracking-[0.4em] text-xs text-white/60">
                <tr>
                    <th class="px-5 py-4 text-left border-b border-r border-white/50">Kode</th>
                    <th class="px-5 py-4 text-left border-b border-r border-white/50">Periode</th>
                    <th class="px-5 py-4 text-left border-b border-r border-white/50">Total</th>
                    <th class="px-5 py-4 text-left border-b border-r border-white/50">Status</th>
                    <th class="px-5 py-4 text-left border-b border-r border-white/50">Detail</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($rentals as $rental)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-5 py-4 font-semibold text-white border-b border-r border-white/50">{{ $rental->rental_code }}</td>
                        <td class="px-5 py-4 border-b border-r border-white/50">{{ $rental->start_date->format('d M Y') }} - {{ $rental->end_date->format('d M Y') }}</td>
                        <td class="px-5 py-4 font-semibold text-aurora border-b border-r border-white/50">Rp{{ number_format($rental->total_price, 0, ',', '.') }}</td>
                        <td class="px-5 py-4 border-b border-r border-white/50">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-aurora/10 text-aurora border border-aurora/30">{{ ucfirst($rental->status) }}</span>
                        </td>
                        <td class="px-5 py-4 space-y-1 border-b border-r border-white/50">
                            @foreach($rental->items as $item)
                                <p>{{ $item->comic->title ?? 'Komik dihapus' }} ({{ $item->quantity }} buku)</p>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-8 text-white/60">
        {{ $rentals->links() }}
    </div>
@endsection

