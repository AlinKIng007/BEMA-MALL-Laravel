@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">Products</h1>
            <x-mall-dropdown :malls="$malls" />
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($products as $product)
                <div class="product-card bg-white rounded-lg shadow-md overflow-hidden" data-mall="{{ $product->mall->name }}">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $product->name }}</h3>
                        <p class="text-gray-600 mt-1">{{ $product->description }}</p>
                        <div class="mt-2 flex justify-between items-center">
                            <span class="text-gray-500 text-sm">{{ $product->mall->name }}</span>
                            <span class="text-green-600 font-semibold">${{ number_format($product->price, 2) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection 