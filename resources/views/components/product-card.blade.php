<div class="product-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300" data-category="{{ $product->category }}">
    <div class="relative">
        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-48 object-cover">
        <div class="absolute top-2 right-2">
            <button onclick="window.open('/quickview?id={{ $product->id }}', 'Quick View', 'width=800,height=600')" 
                    class="bg-white p-2 rounded-full shadow-md hover:bg-gray-100">
                <i class="fas fa-eye text-gray-600"></i>
            </button>
        </div>
    </div>
    <div class="p-4">
        <h3 class="product-title text-lg font-semibold mb-2">{{ $product->name }}</h3>
        <p class="product-description text-gray-600 text-sm mb-4">{{ $product->description }}</p>
        <div class="flex justify-between items-center">
            <span class="text-red-600 font-bold">${{ number_format($product->price, 2) }}</span>
            <button onclick="addToCart({{ $product->id }})" 
                    class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors">
                <i class="fas fa-shopping-cart mr-2"></i>Add to Cart
            </button>
        </div>
    </div>
</div> 