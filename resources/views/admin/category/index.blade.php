@extends('layouts.app')

@section('admin-content')
    <div class="container mx-auto p-6 sm:p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Category</h1>
            <a href="{{ route('category.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow">
                + Create Category
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
                        <th class="py-3 px-6 text-left">Name</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @foreach ($categories as $category)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $category->id }}</td>
                            <td class="py-3 px-6">{{ $category->name }}</td>
                          
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
