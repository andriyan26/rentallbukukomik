<div class="grid md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-semibold text-white/70 mb-2">Judul</label>
        <input type="text" name="title" value="{{ old('title', $comic->title ?? '') }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
    </div>
    <div>
        <label class="block text-sm font-semibold text-white/70 mb-2">Kategori</label>
        <select name="category_id" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
            <option class="text-midnight" value="">-- pilih kategori --</option>
            @foreach($categories as $category)
                <option class="text-midnight" value="{{ $category->id }}" @selected(old('category_id', $comic->category_id ?? '') == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="grid md:grid-cols-3 gap-4 mt-4">
    <div>
        <label class="block text-sm font-semibold text-white/70 mb-2">Penulis</label>
        <input type="text" name="author" value="{{ old('author', $comic->author ?? '') }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
    </div>
    <div>
        <label class="block text-sm font-semibold text-white/70 mb-2">Penerbit</label>
        <input type="text" name="publisher" value="{{ old('publisher', $comic->publisher ?? '') }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
    </div>
    <div>
        <label class="block text-sm font-semibold text-white/70 mb-2">Tahun rilis</label>
        <input type="number" name="release_year" value="{{ old('release_year', $comic->release_year ?? '') }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
    </div>
</div>
<div class="grid md:grid-cols-3 gap-4 mt-4">
    <div>
        <label class="block text-sm font-semibold text-white/70 mb-2">Stok</label>
        <input type="number" name="stock" value="{{ old('stock', $comic->stock ?? 0) }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
    </div>
    <div>
        <label class="block text-sm font-semibold text-white/70 mb-2">Harga sewa / hari</label>
        <input type="number" name="daily_price" value="{{ old('daily_price', $comic->daily_price ?? 0) }}" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
    </div>
    <div>
        <label class="block text-sm font-semibold text-white/70 mb-2">Status</label>
        <select name="status" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">
            <option class="text-midnight" value="available" @selected(old('status', $comic->status ?? 'available') === 'available')>Available</option>
            <option class="text-midnight" value="unavailable" @selected(old('status', $comic->status ?? 'available') === 'unavailable')>Unavailable</option>
        </select>
    </div>
</div>
<div class="mt-4">
    <label class="block text-sm font-semibold text-white/70 mb-2">Cover (opsional)</label>
    <input type="file" name="cover_image" class="w-full text-white/70">
    @if(!empty($comic?->cover_image))
        <p class="text-sm text-white/60 mt-2">Cover saat ini: {{ $comic->cover_image }}</p>
    @endif
</div>
<div class="mt-4">
    <label class="block text-sm font-semibold text-white/70 mb-2">Sinopsis</label>
    <textarea name="synopsis" rows="5" class="w-full rounded-2xl border border-white/10 bg-white/5 px-4 py-3 text-white focus:ring-2 focus:ring-aurora">{{ old('synopsis', $comic->synopsis ?? '') }}</textarea>
</div>

