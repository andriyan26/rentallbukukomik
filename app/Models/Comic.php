<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Comic extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'author',
        'publisher',
        'release_year',
        'stock',
        'daily_price',
        'cover_image',
        'synopsis',
        'status',
    ];

    protected $casts = [
        'daily_price' => 'decimal:2',
        'release_year' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function rentalItems(): HasMany
    {
        return $this->hasMany(RentalItem::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available')->where('stock', '>', 0);
    }

    public function getCoverUrlAttribute(): string
    {
        $cover = $this->cover_image;

        if (! $cover) {
            return 'https://placehold.co/400x560/0f172a/ffffff?text=Komik';
        }

        if (Str::startsWith($cover, ['http://', 'https://'])) {
            return $cover;
        }

        if (Storage::disk('public')->exists($cover)) {
            return asset('storage/'.$cover);
        }

        $publicPath = public_path($cover);

        if (file_exists($publicPath)) {
            return asset($cover);
        }

        return 'https://placehold.co/400x560/0f172a/ffffff?text=Komik';
    }
}




