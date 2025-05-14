<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductShop;
use App\Models\shop;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('view-product'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $products = Products::with(['category', 'subCategory'])->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        abort_if(Gate::denies('create-product'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories    = Category::all();
        $subCategories = SubCategory::all();
        $shops         = Gate::allows('manage-shops') ? shop::all() : [];
        return view('admin.products.form', compact('categories', 'subCategories','shops'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('create-product'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $isAdmin = Gate::allows('manage-shops');
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'price'           => 'required|numeric',
            'quantity'        => 'nullable|integer',
            'size'            => 'nullable|string|max:255',
            'color'           => 'nullable|string|max:255',
            'category_id'     => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'shop_id'         => $isAdmin ? 'required|exists:shops,id' : '',
        ]);
        $product = Products::create($validated);

        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }
        $product->save();
        $shop = $isAdmin ? $request->shop_id : auth()->user()->shop()->first()->id;
        if (!$shop) {
            return response()->json(['message' => 'Shop ID is missing or user has no shop.'], 422);
        }

        ProductShop::create([
            'product_id' => $product->id,
            'shop_id'    => $shop,
            'status'     => 'active',
        ]);

        return response()->json(['message' => 'Product created successfully.']);
    }

    public function edit(Products $product)
    {
        abort_if(Gate::denies('edit-product'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories    = Category::all();
        $subCategories = SubCategory::all();
        $shops         = Gate::allows('manage-shops') ? shop::all() : [];
        return view('admin.products.form', compact('categories', 'subCategories', 'product', 'shops'));
    }
    public function update(Request $request, Products $product)
    {
        abort_if(Gate::denies('edit-product'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $isAdmin = Gate::allows('manage-shops');
        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'price'           => 'required|numeric',
            'quantity'        => 'nullable|integer',
            'size'            => 'nullable|string|max:255',
            'color'           => 'nullable|string|max:255',
            'category_id'     => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'shop_id'         => $isAdmin ? 'required|exists:shops,id' : '',
        ]);

        $product->update($validated);
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('products', 'public');
        }
        $product->save();
        $shopId = $isAdmin ? $request->shop_id : auth()->user()->shop()->first()->id;

        if (!$shopId) {
            return response()->json(['message' => 'Shop ID is missing.'], 422);
        }

        ProductShop::updateOrCreate(
            ['product_id' => $product->id],
            [ 'shop_id' => $shopId, 
              'status' => 'active']
        );

        return response()->json(['message' => 'Product updated successfully.']);
    }
}
