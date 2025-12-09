@extends('layouts.dashboard')

@section('title', 'Komik')

@section('content')
    <div class="flex items-center justify-between mb-8">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-white/50">Master Data</p>
            <h1 class="text-3xl font-bold text-white">Daftar Komik</h1>
        </div>
        <a href="{{ route('dashboard.comics.create') }}" class="px-5 py-3 rounded-full bg-gradient-to-r from-aurora to-lilac text-midnight font-semibold drop-shadow-neon">Tambah Komik</a>
    </div>

    <div class="rounded-3xl border border-white/10 bg-white/5 backdrop-blur-2xl overflow-hidden">
        <table class="min-w-full divide-y divide-white/10 text-sm text-white/80">
            <thead class="bg-white/5 uppercase tracking-[0.4em] text-xs text-white/60">
                <tr>
                    <th class="px-5 py-4 text-center border-b border-r border-white/50">Cover</th>
                    <th class="px-5 py-4 text-center border-b border-r border-white/50">Judul</th>
                    <th class="px-5 py-4 text-center border-b border-r border-white/50">Kategori</th>
                    <th class="px-5 py-4 text-center border-b border-r border-white/50">Harga/Hari</th>
                    <th class="px-5 py-4 text-center border-b border-r border-white/50">Stok</th>
                    <th class="px-5 py-4 text-center border-b border-r border-white/50">Status</th>
                    <th class="px-5 py-4 text-center border-b border-r border-white/50">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($comics as $comic)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-5 py-4 text-center border-b border-r border-white/50">
                            <img src="{{ $comic->cover_url }}" alt="Cover {{ $comic->title }}" class="h-14 w-10 object-cover rounded-lg border border-white/10" loading="lazy">
                        </td>
                        <td class="px-5 py-4 font-semibold text-white text-center border-b border-r border-white/50">{{ $comic->title }}</td>
                        <td class="px-5 py-4 text-center border-b border-r border-white/50">{{ $comic->category->name }}</td>
                        <td class="px-5 py-4 font-semibold text-aurora text-center border-b border-r border-white/50">Rp{{ number_format($comic->daily_price, 0, ',', '.') }}</td>
                        <td class="px-5 py-4 text-center border-b border-r border-white/50">{{ $comic->stock }}</td>
                        <td class="px-5 py-4 text-center border-b border-r border-white/50">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $comic->status === 'available' ? 'bg-emerald-400/10 text-emerald-200 border border-emerald-300/30' : 'bg-white/10 text-white/60 border border-white/20' }}">
                                {{ ucfirst($comic->status) }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center flex justify-center gap-3 border-b border-r border-white/50">
                            <a href="{{ route('dashboard.comics.edit', $comic) }}" class="text-aurora font-semibold text-sm bg-transparent hover:bg-aurora hover:text-white rounded py-2 px-4 transition-colors duration-200">Edit</a>

                            <form method="POST" action="{{ route('dashboard.comics.destroy', $comic) }}" onsubmit="return confirm('Hapus komik ini?')">
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
        {{ $comics->links() }}
    </div>
@endsection
