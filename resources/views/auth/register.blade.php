@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="max-w-3xl mx-auto rounded-[32px] border border-white/10 bg-white/5 backdrop-blur-2xl p-10 text-white shadow-2xl">
        <h1 class="text-4xl font-bold mb-6">Registrasi Pengguna Baru</h1>
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-white/70 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-white/70 mb-2">Username</label>
                    <input type="text" name="username" value="{{ old('username') }}" required class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-white/70 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-white/70 mb-2">Nomor HP</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold text-white/70 mb-2">Alamat</label>
                <textarea name="address" rows="3" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">{{ old('address') }}</textarea>
            </div>
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-white/70 mb-2">Password</label>
                    <input type="password" name="password" required class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-white/70 mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" required class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
                </div>
            </div>
            <button class="w-full px-5 py-3 rounded-full bg-gradient-to-r from-gold to-aurora text-midnight font-semibold drop-shadow-neon">Daftar Sekarang</button>
        </form>
    </div>
@endsection

