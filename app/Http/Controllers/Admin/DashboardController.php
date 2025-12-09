<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comic;
use App\Models\Rental;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'members' => User::where('role', 'member')->count(),
            'staffs' => User::whereIn('role', ['staff', 'admin'])->count(),
            'comics' => Comic::count(),
            'activeRentals' => Rental::whereIn('status', ['ongoing', 'confirmed', 'pending'])->count(),
        ];

        $latestRentals = Rental::with(['user', 'items.comic'])
            ->latest()
            ->take(5)
            ->get();

        $categorySummary = Category::withCount('comics')->get();

        return view('dashboard.index', compact('stats', 'latestRentals', 'categorySummary'));
    }
}




