<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalItems' => Item::count(),
            'inStock' => Item::where('stock', '>', 0)->count(),
            'outOfStock' => Item::where('stock', '=', 0)->count(),
            'deletedItems' => Item::onlyTrashed()->count(),
            'recentItems' => Item::latest()->take(5)->get(),
        ]);
    }
}
