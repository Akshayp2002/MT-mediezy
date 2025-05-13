<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('view-category'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categories = Category::get();
        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        abort_if(Gate::denies('create-category'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('admin.category.form');
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('create-category'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'name' => 'required|unique:categories',
        ]);
        Category::create(['name' => $request->name]);
        return redirect()->route('category.index')->with('success', 'Category created Successfully');
    }
}
