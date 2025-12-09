<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with(['user', 'staff', 'items.comic'])
            ->latest()
            ->paginate(15);

        return view('dashboard.rentals.index', compact('rentals'));
    }

    public function show(Rental $rental)
    {
        $rental->load(['user', 'staff', 'items.comic']);

        return view('dashboard.rentals.show', compact('rental'));
    }

    public function update(Request $request, Rental $rental)
    {
        $data = $request->validate([
            'status' => ['required', 'in:pending,confirmed,ongoing,completed,cancelled,overdue'],
            'notes' => ['nullable', 'string'],
        ]);

        $data['staff_id'] = $request->user()->id;

        $rental->update($data);

        return back()->with('success', 'Status penyewaan diperbarui.');
    }

    public function destroy(Rental $rental)
    {
        $rental->delete();

        return redirect()->route('dashboard.rentals.index')->with('success', 'Data penyewaan dihapus.');
    }
}




