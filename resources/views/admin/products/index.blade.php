@extends('layouts.app')

@section('admin-content')
    <div class="container mx-auto p-6 sm:p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Products</h1>
            <a href="{{ route('products.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow">
                + Create Product
            </a>
        </div>

        <!-- Alert Messages -->
        <x-alert-messages />

        <!-- Table -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Image</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Price</th>
                        <th class="py-3 px-6 text-left">Quantity</th>
                        <th class="py-3 px-6 text-left">Category</th>
                        <th class="py-3 px-6 text-left">Subcategory</th>
                        {{-- <th class="py-3 px-6 text-center">Actions</th> --}}
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @foreach ($products as $product)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $product->id }}</td>
                            <td class="py-3 px-6">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image"
                                        class="w-12 h-12 object-cover rounded">
                                @else
                                    <span class="text-gray-500">No Image</span>
                                @endif
                            </td>
                            <td class="py-3 px-6">{{ $product->name }}</td>
                            <td class="py-3 px-6">₹{{ number_format($product->price, 2) }}</td>
                            <td class="py-3 px-6">{{ $product->quatity ?? 'N/A' }}</td>
                            <td class="py-3 px-6">{{ $product->category->name ?? 'N/A' }}</td>
                            <td class="py-3 px-6">{{ $product->subCategory->name ?? 'N/A' }}</td>
                            {{-- <td class="py-3 px-6 text-center">
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="bg-blue-500 text-white px-3 py-1 rounded">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    class="inline-block" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">
                                        Delete
                                    </button>
                                </form>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
