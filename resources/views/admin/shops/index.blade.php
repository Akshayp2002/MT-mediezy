@extends('layouts.app')

@section('admin-content')
    <div class="container mx-auto p-6 sm:p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Shops</h1>
            <a href="{{ route('shops.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow">
                + Create Shops
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
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Address</th>
                        <th class="py-3 px-6 text-left">Edit</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 text-sm">
                    @foreach ($shops as $shop)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6">{{ $shop->id }}</td>
                            <td class="py-3 px-6">{{ $shop->name }}</td>
                            <td class="py-3 px-6">{{ $shop->owner->email }}</td>
                            <td class="py-3 px-6">{{ $shop->address }}</td>
                            <td class="py-3 px-6">
                                <a href="{{ route('shops.edit', $shop->id) }}"
                                    class="text-blue-600 hover:underline">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
