<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Auth;

class CartController extends Controller
{
    public function index()
    {
        $products = Cart::where('user_id', Auth::user()->id)->where('order_status', 'pending')->get();

        return view('admin.carts.carts', compact('products'));
    }

    public function store(Request $request)
    {
        $product = Products::findOrFail($request->product_id);

        Cart::firstOrCreate([
            'user_id'    => Auth::id(),
            'product_id' => $product->id,
        ]);

        return back()->with('success', 'Product added to cart successfully!');
    }
}
