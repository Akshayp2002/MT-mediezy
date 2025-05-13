<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @section('content')
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
            <!-- Alert Messages -->
            <x-alert-messages />

            <div class="p-4 mx-auto lg:max-w-6xl md:max-w-4xl">
                <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-6 sm:mb-12">Products</h2>

                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                    @foreach ($products as $product)
                        <div
                            class="bg-white flex flex-col rounded overflow-hidden shadow-md cursor-pointer hover:scale-[1.01] transition-all">
                            <div class="w-full">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Product 1"
                                    class="w-full object-cover object-top aspect-[230/307]" />
                            </div>
                            <div class="p-4 flex-1 flex flex-col">
                                <div class="flex-1">
                                    <h5 class="text-sm sm:text-base font-semibold text-slate-900 line-clamp-2">
                                        {{ $product->name ?? 'name' }}
                                    </h5>
                                    <div class="mt-2 flex items-center flex-wrap gap-2">
                                        <h6 class="text-sm sm:text-base font-semibold text-slate-900">
                                            ${{ $product->price ?? 'NA' }}</h6>
                                    </div>
                                </div>
                                <form action="{{ route('carts.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <button type="submit"
                                        class="text-sm px-2 py-2 font-medium w-full mt-4 bg-blue-600 hover:bg-blue-700 text-white tracking-wide ml-auto outline-none border-none rounded">
                                        Add to cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endsection
</x-app-layout>
