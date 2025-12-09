@extends('layouts.app')

@section('title', 'Sistem Informasi Rental Komik')

@section('content')
    <section class="grid lg:grid-cols-2 gap-12 items-center">
        <div class="space-y-6">
            <p class="inline-flex items-center gap-2 text-xs uppercase tracking-[0.4em] text-white/60">
                <span class="h-2 w-2 rounded-full bg-aurora animate-pulse"></span>
                Sistem Informasi Rental Komik
            </p>
            <h1 class="text-4xl lg:text-5xl font-bold leading-tight text-white">
                Kelola Penyewaan Buku Komik dengan <span class="text-aurora">Mudah</span> dan <span class="text-lilac">Cepat</span>.
            </h1>
            <p class="text-lg text-white/70 max-w-2xl">
                Portal yang menyediakan katalog lengkap buku komik dengan fitur pencarian cepat, proses penyewaan yang praktis, serta manajemen data yang terintegrasi. Dengan sistem digital yang efisien, pengunjung, member, staff, dan admin dapat bekerja sama dengan lancar, memastikan pengalaman penyewaan yang menyenangkan dan bebas hambatan.
            </p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('catalog') }}" class="px-6 py-3 rounded-full bg-gradient-to-r from-aurora to-lilac text-midnight font-semibold drop-shadow-neon">
                    Sewa Buku dan Bergabung Sekarang
                </a>
                <a href="{{ route('about') }}" class="px-6 py-3 rounded-full border border-white/30 text-white/80 hover:text-white transition">
                    Jelajahi Koleksi
                </a>
            </div>
            <div class="grid grid-cols-3 gap-6 pt-4">
                <div>
                    <p class="text-3xl font-semibold text-white">450+</p>
                    <p class="text-white/50 text-sm">Koleksi Komik yang Tersedia</p>
                </div>
                <div>
                    <p class="text-3xl font-semibold text-white">24/7</p>
                    <p class="text-white/50 text-sm">Akses dan Layanan Sepanjang Waktu</p>
                </div>
                <div>
                    <p class="text-3xl font-semibold text-white">4</p>
                    <p class="text-white/50 text-sm">Tipe Pengguna Aktif</p>
                </div>
            </div>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-[32px] p-10 backdrop-blur-2xl shadow-2xl">
            <h2 class="text-xl font-semibold text-white mb-6">Kenapa Memilih Sistem Rental Buku Komik Ini?</h2>
            <div class="space-y-5 text-white/80">
                <div class="flex items-start gap-4">
                    <span class="h-10 w-10 rounded-2xl bg-gradient-to-br from-lilac to-indigo-500 flex items-center justify-center text-lg">1</span>
                    <div>
                        <p class="font-semibold text-white">Katalog Buku Komik Lengkap & Terupdate</p>
                        <p class="text-sm text-white/70">Temukan berbagai koleksi komik dari berbagai genre yang selalu terupdate.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <span class="h-10 w-10 rounded-2xl bg-gradient-to-br from-aurora to-sky-500 flex items-center justify-center text-lg">2</span>
                    <div>
                        <p class="font-semibold text-white">Penyewaan Buku yang Mudah dan Cepat</p>
                        <p class="text-sm text-white/70">Proses penyewaan yang praktis, dengan fitur pemesanan dan pembayaran online yang mudah.</p>
                    </div>
                </div>
                <div class="flex items-start gap-4">
                    <span class="h-10 w-10 rounded-2xl bg-gradient-to-br from-gold to-rose-400 flex items-center justify-center text-lg">3</span>
                    <div>
                        <p class="font-semibold text-white">Tampilan User-Friendly & Profesional</p>
                        <p class="text-sm text-white/70">Sistem dirancang untuk memudahkan pengguna dalam mencari, memesan, dan mengelola penyewaan buku komik.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mt-16">
        <div class="flex items-center justify-between mb-8">
            <div>
                <p class="text-xs uppercase tracking-[0.5em] text-white/50">Kategori</p>
                <h2 class="text-3xl font-semibold text-white">Kurasi genre terbaik</h2>
            </div>
            <a href="{{ route('catalog') }}" class="text-sm font-semibold text-aurora hover:text-white">Lihat katalog lengkap →</a>
        </div>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($categories as $category)
                <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-xl p-6 shadow-xl">
                    <p class="text-white/50 text-sm mb-1">{{ $category->comics_count }} judul</p>
                    <p class="text-lg font-semibold text-white">{{ $category->name }}</p>
                    <p class="mt-2 text-sm text-white/70 line-clamp-3">{{ $category->description }}</p>
                </div>
            @endforeach
        </div>
    </section>

    <section class="mt-16">
        <div class="flex items-center justify-between mb-8">
            <div>
                <p class="text-xs uppercase tracking-[0.5em] text-white/50">Highlight Koleksi</p>
                <h2 class="text-3xl font-semibold text-white">Komik terbaru pilihan editor</h2>
            </div>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($latestComics as $comic)
                <a href="{{ route('catalog.show', $comic) }}" class="rounded-[28px] p-6 border border-white/10 bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-xl hover:border-aurora/50 transition">
                    <div class="flex items-center justify-between text-sm text-white/60">
                        <span>{{ $comic->category->name }}</span>
                        <span>{{ $comic->release_year }}</span>
                    </div>
                    <h3 class="mt-3 text-2xl font-semibold text-white">{{ $comic->title }}</h3>
                    <p class="text-white/60">{{ $comic->author }}</p>
                    <p class="mt-4 text-3xl font-bold text-aurora">Rp{{ number_format($comic->daily_price, 0, ',', '.') }}<span class="text-sm text-white/60"> / hari</span></p>
                    <p class="text-white/60 text-sm mt-1">{{ $comic->stock }} stok tersedia</p>
                </a>
            @endforeach
        </div>
    </section>

    <section class="mt-16">
        <div class="flex items-center justify-between mb-6">
            <div>
                <p class="text-xs uppercase tracking-[0.5em] text-white/50">Aktivitas Real-time</p>
                <h2 class="text-3xl font-semibold text-white">Transaksi penyewaan terbaru</h2>
            </div>
        </div>
        <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-2xl overflow-hidden">
            <table class="min-w-full text-left text-sm text-white/80">
                <thead class="uppercase text-white/60 tracking-[0.4em] text-xs">
                    <tr>
                        <th class="px-6 py-4">Kode</th>
                        <th class="px-6 py-4">Peminjam</th>
                        <th class="px-6 py-4">Rentang</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($popularRentals as $rental)
                        <tr class="hover:bg-white/5 transition">
                            <td class="px-6 py-4 font-semibold text-white">{{ $rental->rental_code }}</td>
                            <td class="px-6 py-4">{{ $rental->user->name ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $rental->start_date->format('d M') }} — {{ $rental->end_date->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-aurora/10 text-aurora border border-aurora/40">
                                    {{ ucfirst($rental->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
@endsection

