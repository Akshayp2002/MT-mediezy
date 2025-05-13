@extends('layouts.app')

@section('admin-content')
    <div class="container mx-auto p-6 sm:p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Carts</h1>
        </div>
        <!-- Alert Messages -->
        <x-alert-messages />
        <div class="py-12">
            <div class="p-4 mx-auto lg:max-w-6xl md:max-w-4xl">
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-6 sm:mb-12">Cart Products</h2>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                    @foreach ($products as $product)
                        <div
                            class="bg-white flex flex-col rounded overflow-hidden shadow-md cursor-pointer hover:scale-[1.01] transition-all">
                            <div class="w-full">
                                <img src="{{ asset('storage/' . $product->product->image) }}" alt="Product 1"
                                    class="w-full object-cover object-top aspect-[230/307]" />
                            </div>
                            <div class="p-4 flex-1 flex flex-col">
                                <div class="flex-1">
                                    <h5 class="text-sm sm:text-base font-semibold text-slate-900 line-clamp-2">
                                        {{ $product->product->name ?? 'name' }}
                                    </h5>
                                    <div class="mt-2 flex items-center flex-wrap gap-2">
                                        <h6 class="text-sm sm:text-base font-semibold text-slate-900">
                                            ${{ $product->product->price ?? 'NA' }}</h6>
                                    </div>
                                </div>
                                <button type="button"
                                    class="text-sm px-2 py-2 font-medium w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white tracking-wide ml-auto outline-none border-none rounded">Buy
                                    now</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
