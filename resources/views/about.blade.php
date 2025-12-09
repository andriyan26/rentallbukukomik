@extends('layouts.app')

@section('title', 'Tentang Sistem')

@section('content')
    <div class="rounded-[32px] border border-white/10 bg-white/5 backdrop-blur-2xl p-10 text-white shadow-2xl">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
            <div>
                <p class="text-xs uppercase tracking-[0.5em] text-white/50">Tentang Kami</p>
                <h1 class="text-4xl font-bold mt-3">Sistem Informasi Rental Buku Komik </h1>
            </div>
            <div class="grid grid-cols-3 gap-4 text-center">
                <div>
                    <p class="text-3xl font-semibold text-aurora">4</p>
                    <p class="text-xs text-white/60">Jenis Pengguna Aktif</p>
                </div>
                <div>
                    <p class="text-3xl font-semibold text-lilac">100%</p>
                    <p class="text-xs text-white/60">Sistem Terintegrasi & Otomatis</p>
                </div>
                <div>
                    <p class="text-3xl font-semibold text-gold">Live</p>
                    <p class="text-xs text-white/60">Dashboard</p>
                </div>
            </div>
        </div>
        <p class="mt-6 text-white/70 leading-relaxed">
            Kami menghadirkan platform rental buku komik digital dengan desain futuristik dan sistem yang mudah digunakan. Aplikasi kami memudahkan pengunjung dan member untuk mencari, menyewa, dan mengelola koleksi buku komik favorit mereka kapan saja. Dengan dukungan teknologi Laravel, kami memastikan setiap detail mulai dari katalog, transaksi, hingga laporan analitik berjalan secara otomatis dan terintegrasi, memberikan pengalaman yang efisien baik untuk pengguna maupun admin.
        </p>

        <div class="grid md:grid-cols-2 gap-8 mt-10">
            <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                <h2 class="text-xl font-semibold mb-4">Visi dan Misi</h2>
                <div class="space-y-3 text-white/70">
                     <p><span class="text-white font-semibold">Misi Kami:</span> Memberikan solusi penyewaan buku komik yang cepat, aman, dan mudah, serta menyajikan katalog komik yang selalu terupdate dengan berbagai genre untuk memenuhi kebutuhan hiburan setiap pengguna.</p>
                     <p><span class="text-white font-semibold">Visi Kami:</span> Menjadi platform penyewaan buku komik terpercaya dan terlengkap, dengan inovasi dan kemudahan digital yang mengutamakan kenyamanan pengguna.</p>
                </div>
            </div>
            <div class="rounded-3xl border border-white/10 bg-white/5 p-6">
                <h2 class="text-xl font-semibold mb-4">Fitur Utama</h2>
                <ul class="space-y-3 text-white/70">
                    <li>Pencarian Cepat & Praktis untuk menemukan komik favorit dengan mudah.</li>
                    <li>Sistem Transaksi Otomatis untuk mempermudah penyewaan dan pembayaran.</li>
                    <li>Dashboard Admin yang memungkinkan pengelolaan stok dan laporan secara efisien.</li>
                    <li>UI Modern dan Responsif untuk pengalaman pengguna yang menyenangkan.</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

