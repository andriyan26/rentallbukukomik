@extends('layouts.dashboard')

@section('title', 'Overview')

@section('content')
    <h1 class="text-4xl font-bold text-white mb-8">Dashboard Admin</h1>

    {{-- kartu statistik utama dengan diagram bar --}}
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        {{-- Total Komik --}}
        <div class="rounded-3xl border border-white/10 bg-gradient-to-br from-white/10 to-white/5 p-6 flex flex-col items-center text-center gap-4">
            <div class="h-12 w-12 rounded-2xl bg-white/10 flex items-center justify-center text-2xl">📚</div>
            <div>
                <p class="text-xs uppercase tracking-[0.35em] text-white/60">Total Komik</p>
                <p class="text-4xl font-bold text-aurora mt-1">{{ $stats['comics'] }}</p>
            </div>
            <div class="w-full mt-2">
                <div class="w-full h-1.5 rounded-full bg-white/10 overflow-hidden">
                    <div class="h-full bg-aurora/80" style="width: 80%;"></div>
                </div>
            </div>
        </div>

        {{-- Peminjam --}}
        <div class="rounded-3xl border border-white/10 bg-gradient-to-br from-white/10 to-white/5 p-6 flex flex-col items-center text-center gap-4">
            <div class="h-12 w-12 rounded-2xl bg-white/10 flex items-center justify-center text-2xl">👤</div>
            <div>
                <p class="text-xs uppercase tracking-[0.35em] text-white/60">Peminjam</p>
                <p class="text-4xl font-bold text-aurora mt-1">{{ $stats['members'] }}</p>
            </div>
            <div class="w-full mt-2">
                <div class="w-full h-1.5 rounded-full bg-white/10 overflow-hidden">
                    <div class="h-full bg-aurora/80" style="width: 60%;"></div>
                </div>
            </div>
        </div>

        {{-- Petugas --}}
        <div class="rounded-3xl border border-white/10 bg-gradient-to-br from-white/10 to-white/5 p-6 flex flex-col items-center text-center gap-4">
            <div class="h-12 w-12 rounded-2xl bg-white/10 flex items-center justify-center text-2xl">🛠</div>
            <div>
                <p class="text-xs uppercase tracking-[0.35em] text-white/60">Petugas</p>
                <p class="text-4xl font-bold text-aurora mt-1">{{ $stats['staffs'] }}</p>
            </div>
            <div class="w-full mt-2">
                <div class="w-full h-1.5 rounded-full bg-white/10 overflow-hidden">
                    <div class="h-full bg-aurora/80" style="width: 40%;"></div>
                </div>
            </div>
        </div>

        {{-- Sewa Aktif --}}
        <div class="rounded-3xl border border-white/10 bg-gradient-to-br from-white/10 to-white/5 p-6 flex flex-col items-center text-center gap-4">
            <div class="h-12 w-12 rounded-2xl bg-white/10 flex items-center justify-center text-2xl">🔄</div>
            <div>
                <p class="text-xs uppercase tracking-[0.35em] text-white/60">Sewa Aktif</p>
                <p class="text-4xl font-bold text-aurora mt-1">{{ $stats['activeRentals'] }}</p>
            </div>
            <div class="w-full mt-2">
                <div class="w-full h-1.5 rounded-full bg-white/10 overflow-hidden">
                    <div class="h-full bg-aurora/80" style="width: 50%;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- aktivitas & ringkasan kategori --}}
    <div class="grid lg:grid-cols-2 gap-6">
        <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl overflow-hidden">
            <div class="p-5 border-b border-white/10 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-white">Aktivitas Terbaru</h2>
                <span class="text-xs text-white/50 uppercase tracking-[0.3em]">Real-time</span>
            </div>
            <div class="divide-y divide-white/5">
                @forelse($latestRentals as $rental)
                    <div class="p-5 text-sm text-white/80">
                        <p class="font-semibold text-white">{{ $rental->rental_code }} - {{ $rental->user->name ?? 'Pengguna dihapus' }}</p>
                        <p class="text-white/60">{{ $rental->start_date->format('d M') }} - {{ $rental->end_date->format('d M Y') }}</p>
                        <p class="mt-2 text-white/70">
                            @foreach($rental->items as $item)
                                {{ $item->comic->title }} ({{ $item->quantity }} buku)
                            @endforeach
                        </p>
                    </div>
                @empty
                    <p class="p-5 text-sm text-white/60">Belum ada aktivitas penyewaan.</p>
                @endforelse
            </div>
        </div>
        <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl overflow-hidden">
            <div class="p-5 border-b border-white/10 flex items-center justify-between">
                <h2 class="text-xl font-semibold text-white">Ringkasan Kategori</h2>
                <span class="text-xs text-white/50 uppercase tracking-[0.3em]">Judul tersedia</span>
            </div>
            <div class="divide-y divide-white/5">
                @foreach($categorySummary as $category)
                    <div class="p-5 flex items-center justify-between text-sm">
                        <div>
                            <p class="font-semibold text-white">{{ $category->name }}</p>
                            <p class="text-white/60">{{ $category->description }}</p>
                        </div>
                        <span class="text-2xl font-bold text-aurora">{{ $category->comics_count }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

