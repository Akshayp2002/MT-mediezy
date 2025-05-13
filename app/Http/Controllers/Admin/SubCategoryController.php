<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class SubCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('create-sub-category'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $subcategories = SubCategory::get();
        return view('admin.subCategory.index', compact('subcategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('create-sub-category'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::get();
        return view('admin.subCategory.form', compact('categories'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('create-sub-category'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
        ]);

        SubCategory::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
        ]);

        return redirect()->back()->with('success', 'Subcategory created successfully.');
    }
}
