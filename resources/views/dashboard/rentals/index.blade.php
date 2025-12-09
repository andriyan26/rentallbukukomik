@extends('layouts.dashboard')

@section('title', 'Penyewaan')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-white/50">Transaksi</p>
            <h1 class="text-3xl font-bold text-white">Data Penyewaan</h1>
        </div>
    </div>

    <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-2xl overflow-hidden">
        <table class="min-w-full divide-y divide-white/10 text-sm text-white/80">
            <thead class="bg-white/5 text-xs uppercase tracking-[0.4em] text-white/60">
                <tr>
                    <th class="px-5 py-4 text-center border-b border-r border-white/50">Kode</th>
                    <th class="px-5 py-4 text-center border-b border-r border-white/50">Peminjam</th>
                    <th class="px-5 py-4 text-center border-b border-r border-white/50">Tanggal</th>
                    <th class="px-5 py-4 text-center border-b border-r border-white/50">Total</th>
                    <th class="px-5 py-4 text-center border-b border-r border-white/50">Status</th>
                    <th class="px-5 py-4 text-center border-b border-r border-white/50">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($rentals as $rental)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-5 py-4 text-center font-semibold text-white border-b border-r border-white/50">{{ $rental->rental_code }}</td>
                        <td class="px-5 py-4 text-center text-white/70 border-b border-r border-white/50">{{ $rental->user->name ?? 'Pengguna dihapus' }}</td>
                        <td class="px-5 py-4 text-center text-white/70 border-b border-r border-white/50">{{ $rental->start_date->format('d M Y') }} - {{ $rental->end_date->format('d M Y') }}</td>
                        <td class="px-5 py-4 text-center font-semibold text-aurora border-b border-r border-white/50">Rp{{ number_format($rental->total_price, 0, ',', '.') }}</td>
                        <td class="px-5 py-4 text-center border-b border-r border-white/50">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-aurora/10 text-aurora border border-aurora/30">{{ ucfirst($rental->status) }}</span>
                        </td>
                        <td class="px-5 py-4 text-center flex justify-center gap-3 border-b border-r border-white/50">
                            <a href="{{ route('dashboard.rentals.show', $rental) }}" class="text-aurora font-semibold text-sm bg-transparent hover:bg-aurora hover:text-white rounded py-2 px-4 transition-colors duration-200">Detail</a>

                            <form method="POST" action="{{ route('dashboard.rentals.destroy', $rental) }}" onsubmit="return confirm('Hapus data sewa?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-rose-300 font-semibold text-sm bg-transparent hover:bg-rose-300 hover:text-white rounded py-2 px-4 transition-colors duration-200">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-6 text-white/60">
        {{ $rentals->links() }}
    </div>
@endsection
