<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\User;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::with('owner')->latest()->get();
        return view('admin.shops.index', compact('shops'));
    }

    public function create()
    {
        return view('admin.shops.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'address' => 'nullable|string|max:255',
        ]);

        // Check if user already exists
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser) {
            return response()->json(['error' => 'Email already exists.'], 409);
        }

        // Create user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('shops');

        // Create shop
        Shop::create([
            'user_id' => $user->id,
            'name'    => $request->name,
            'address' => $request->address,
        ]);

        return response()->json(['message' => 'Shop created successfully.']);
    }

    public function edit(Shop $shop)
    {
        return view('admin.shops.form', compact('shop'));
    }

    public function update(Request $request, Shop $shop)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        $shop->update($request->only('name', 'address'));

        return response()->json(['message' => 'Shop updated successfully.']);
    }
}
