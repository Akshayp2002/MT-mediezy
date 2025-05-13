@extends('layouts.app')

@section('admin-content')
    <div class="container mx-auto p-8 flex">
        <div class="max-w-md w-full mx-auto">
            <h1 class="text-4xl text-center mb-12 font-thin">Create Subcategory</h1>

            <!-- Alert Messages -->
            <x-alert-messages />

            <div class="bg-white rounded-lg overflow-hidden shadow-2xl">
                <div class="p-8">
                    <!-- Subcategory Form -->
                    <form method="POST" action="{{ route('subcategory.store') }}">
                        @csrf

                        <!-- Select Category -->
                        <div class="mb-5">
                            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-600">
                                Select Category
                            </label>
                            <select name="category_id" required 
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                                <option value="" disabled selected>Select a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Subcategory Name -->
                        <div class="mb-5">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-600">Subcategory Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                class="block w-full p-3 rounded bg-gray-200 border border-transparent focus:outline-none">
                        </div>


                        <button class="w-full p-3 mt-4 bg-indigo-600 text-white rounded shadow">Create Subcategory</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
