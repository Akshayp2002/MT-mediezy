<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $products = $user->hasRole('shops')
            ? Products::whereHas('productShops', fn($q) => $q->where('shop_id', $user->shop->id ?? 0))->get()
            : Products::all();

        return view('dashboard', compact('products'));
    }
}
