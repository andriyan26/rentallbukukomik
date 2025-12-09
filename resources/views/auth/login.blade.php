@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="max-w-md mx-auto rounded-[32px] border border-white/10 bg-white/5 backdrop-blur-2xl p-10 text-white shadow-2xl">
        <h1 class="text-4xl font-bold mb-6">Masuk</h1>
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-white/70 mb-2">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
            </div>
            <div>
                <label class="block text-sm font-semibold text-white/70 mb-2">Password</label>
                <input type="password" name="password" required class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
            </div>
            <label class="flex items-center gap-2 text-sm text-white/70">
                <input type="checkbox" name="remember" class="rounded border-white/20 bg-transparent">
                Ingat saya
            </label>
            <button class="w-full px-5 py-3 rounded-full bg-gradient-to-r from-aurora to-lilac text-midnight font-semibold drop-shadow-neon">Masuk</button>
        </form>
        <p class="text-center text-sm text-white/60 mt-6">Belum punya akun? <a class="text-aurora font-semibold" href="{{ route('register') }}">Registrasi disini</a></p>
    </div>
@endsection

