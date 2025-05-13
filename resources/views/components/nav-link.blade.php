@props(['active'])

@php
    $classes =
        $active ?? false
            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 dark:border-indigo-600 text-sm font-medium leading-5 text-gray-900 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:border-gray-300 dark:hover:border-gray-700 focus:outline-none focus:text-gray-700 dark:focus:text-gray-300 focus:border-gray-300 dark:focus:border-gray-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
<div class="hidden md:flex items-center space-x-6">
    @can('view-category')
        <a href="{{ route('category.index') }}"
            class="text-gray-700 hover:bg-gray-200 px-4 py-2 rounded {{ request()->is('category') ? 'bg-blue-400 text-white font-bold' : '' }}">
            Category
        </a>
    @endcan

    @can('view-sub-category')
        <a href="{{ route('subcategory.index') }}"
            class="text-gray-700 hover:bg-gray-200 px-4 py-2 rounded {{ request()->is('subcategory') ? 'bg-blue-400 text-white font-bold' : '' }}">
            Sub Category
        </a>
    @endcan

    @can('view-product')
        <a href="{{ route('products.index') }}"
            class="text-gray-700 hover:bg-gray-200 px-4 py-2 rounded {{ request()->is('products') ? 'bg-blue-400 text-white font-bold' : '' }}">
            Products
        </a>
    @endcan

    <a href="{{ route('carts.index') }}"
        class="text-gray-700 hover:bg-gray-200 px-4 py-2 rounded {{ request()->is('carts') ? 'bg-blue-400 text-white font-bold' : '' }}">
        Carts
    </a>

</div>
