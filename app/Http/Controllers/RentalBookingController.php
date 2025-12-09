<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\Rental;
use App\Models\RentalItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RentalBookingController extends Controller
{
    public function index()
    {
        $rentals = Rental::with(['items.comic', 'staff'])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $comics = Comic::available()->orderBy('title')->get();

        return view('rentals.create', compact('comics'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'comic_id' => ['required', 'exists:comics,id'],
            'quantity' => ['required', 'integer', 'min:1'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:start_date'],
        ]);

        $comic = Comic::findOrFail($data['comic_id']);

        if ($data['quantity'] > $comic->stock) {
            return back()->withErrors(['quantity' => 'Stok tidak mencukupi.'])->withInput();
        }

        $rentalDays = Carbon::parse($data['start_date'])->diffInDays(Carbon::parse($data['end_date'])) ?: 1;

        DB::transaction(function () use ($data, $comic, $rentalDays) {
            $rental = Rental::create([
                'user_id' => Auth::id(),
                'rental_code' => 'RENT-'.Str::upper(Str::random(6)),
                'start_date' => $data['start_date'],
                'end_date' => $data['end_date'],
                'rental_days' => $rentalDays,
                'total_price' => 0,
                'status' => 'pending',
            ]);

            $subtotal = $comic->daily_price * $data['quantity'] * $rentalDays;

            RentalItem::create([
                'rental_id' => $rental->id,
                'comic_id' => $comic->id,
                'quantity' => $data['quantity'],
                'price_per_day' => $comic->daily_price,
                'duration_days' => $rentalDays,
                'subtotal' => $subtotal,
            ]);

            $comic->decrement('stock', $data['quantity']);

            $rental->update(['total_price' => $subtotal]);
        });

        return redirect()->route('rentals.index')->with('success', 'Permintaan sewa berhasil dikirim. Silakan tunggu konfirmasi petugas.');
    }
}

