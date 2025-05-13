<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Gate;
use Symfony\Component\HttpFoundation\Response;

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

        $categories = Category::all();
        $subCategories = SubCategory::all();
        return view('admin.products.form', compact('categories', 'subCategories'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('create-product'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'name'            => 'required|string|max:255',
            'price'           => 'required|numeric',
            'quantity'        => 'nullable|integer',
            'size'            => 'nullable|string|max:255',
            'color'           => 'nullable|string|max:255',
            'category_id'     => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'image'           => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product                  = new Products();
        $product->name            = $request->name;
        $product->price           = $request->price;
        $product->quatity         = $request->quantity;
        $product->size            = $request->size;
        $product->color           = $request->color;
        $product->category_id     = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath      = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }
}
