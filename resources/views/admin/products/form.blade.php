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
                    <form id="productForm" enctype="multipart/form-data">
                        @csrf
                        @if (isset($product))
                            @method('PUT')
                        @endif
                        @can('manage-shops')
                            <!-- Shop Admin only -->
                            <div class="mb-5">
                                <label class="block mb-2 text-sm font-medium text-gray-600">Shop</label>
                                <select name="shop_id"
                                    class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                                    <option value="">Select Shop</option>
                                    @foreach ($shops as $shop)
                                        <option value="{{ $shop->id }}" {{ old('shop_id') == $shop->id ? 'selected' : '' }}>
                                            {{ $shop->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endcan

                        <!-- Product Name -->
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Product Name</label>
                            <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" required
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>


                        <!-- Price -->
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Price</label>
                            <input type="number" name="price" step="0.01"
                                value="{{ old('price', $product->price ?? '') }}" required
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>

                        <!-- Quantity -->
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Quantity</label>
                            <input type="number" name="quantity" value="{{ old('quantity', $product->quatity ?? '') }}"
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>

                        <!-- Size -->
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Size</label>
                            <input type="text" name="size" value="{{ old('size', $product->size ?? '') }}"
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>

                        <!-- Color -->
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Color</label>
                            <input type="text" name="color" value="{{ old('color', $product->color ?? '') }}"
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>

                        <!-- Category -->
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Category</label>
                            <select name="category_id" id="category" required
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $product->category_id ?? '') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Subcategory -->
                        <div class="mb-5">
                            <label class="block mb-2 text-sm font-medium text-gray-600">Subcategory</label>
                            <select name="sub_category_id" id="subcategory"
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                                <option value="">Select Subcategory</option>
                                @foreach ($subCategories as $subCategory)
                                    <option value="{{ $subCategory->id }}"
                                        {{ old('sub_category_id', $product->sub_category_id ?? '') == $subCategory->id ? 'selected' : '' }}>
                                        {{ $subCategory->name }}
                                    </option>
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
                            {{ isset($product) ? 'Update Product' : 'Create Product' }}
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        $('#productForm').on('submit', function(e) {
            e.preventDefault();

            const form = document.getElementById('productForm');
            const formData = new FormData(form);

            // Check if method override exists
            const isEdit = form.querySelector('input[name="_method"]')?.value === 'PUT';
            const actionUrl = isEdit ?
                "{{ route('products.update', $product->id ?? 0) }}" :
                "{{ route('products.store') }}";

            $.ajax({
                url: actionUrl,
                method: isEdit ? 'POST' : 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire('Success', response.message || 'Saved successfully!', 'success');
                    if (!isEdit) {
                        $('#productForm')[0].reset();
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        const errors = xhr.responseJSON.errors;
                        const firstKey = Object.keys(errors)[0];
                        Swal.fire('Validation Error', errors[firstKey][0], 'error');
                    } else {
                        Swal.fire('Error', 'An unexpected error occurred.', 'error');
                    }
                }
            });
        });
    </script>
@endsection
