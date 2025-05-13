@extends('layouts.app')

@section('admin-content')
    <div class="container mx-auto p-8 flex">
        <div class="max-w-lg w-full mx-auto">
            <h1 class="text-4xl text-center mb-12 font-thin">Create Product</h1>

            <!-- Alert Messages -->
            <x-alert-messages />

            <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
                <div class="p-8">
                    <!-- Product Form -->
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Product Name -->
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Product Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>

                        <!-- Price -->
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Price</label>
                            <input type="number" name="price" step="0.01" value="{{ old('price') }}" required
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>

                        <!-- Quantity -->
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Quantity</label>
                            <input type="number" name="quantity" value="{{ old('quantity') }}"
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>

                        <!-- Size -->
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Size</label>
                            <input type="text" name="size" value="{{ old('size') }}"
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>

                        <!-- Color -->
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Color</label>
                            <input type="text" name="color" value="{{ old('color') }}"
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>

                        <!-- Category -->
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Category</label>
                            <select name="category_id" id="category" required
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                                <option value="">Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Subcategory -->
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Subcategory</label>
                            <select name="sub_category_id" id="subcategory"
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                                <option value="">Select Subcategory</option>
                                @foreach($subCategories as $subCategory)
                                    <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Product Image</label>
                            <input type="file" name="image" accept="image/*"
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>

                        <!-- Submit Button -->
                        <button class="w-full p-3 mt-4 bg-indigo-600 text-white rounded shadow">
                            Create Product
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
