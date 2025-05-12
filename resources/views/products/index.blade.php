@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Products</h1>
        
        <!-- Mall Filter Dropdown -->
        <div class="relative">
            <button data-dropdown-toggle="mall-dropdown" type="button" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-expanded="false">
                <span>All Malls</span>
                <svg class="w-5 h-5 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div data-dropdown-menu id="mall-dropdown" class="hidden absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10">
                <div class="py-1" role="menu" aria-orientation="vertical">
                    <button data-mall-option="all" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">All Malls</button>
                    @foreach($malls as $mall)
                        <button data-mall-option="{{ $mall->id }}" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">{{ $mall->name }}</button>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($products as $product)
            <div class="product-card bg-white rounded-lg shadow-md overflow-hidden" data-mall="{{ $product->mall_id }}">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                    <p class="text-gray-600 mt-2">{{ $product->description }}</p>
                    <div class="mt-4 flex justify-between items-center">
                        <span class="text-indigo-600 font-bold">${{ number_format($product->price, 2) }}</span>
                        <span class="text-sm text-gray-500">{{ $product->mall->name }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="{{ asset('js/mall-filter.js') }}"></script>
@endsection 