<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold gradient-text">Products</h1>

    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="product-card rounded-lg shadow-md overflow-hidden animate__animated animate__fadeIn" data-mall="<?php echo e($product->mall_id); ?>">
                <!-- Hidden input for product ID -->
                <input type="text" value="<?php echo e($product->id); ?>" style="display: none;">

                <img src="images/<?php echo e($product->image_1); ?>" alt="<?php echo e($product->product_name); ?>" class="w-full h-48 object-cover">
                <div class="p-6">
                    <h3 class="text-xl font-semibold mb-2"><?php echo e($product->product_name); ?></h3>
                    <p class="text-gray-600 mb-4"><?php echo e($product->description); ?></p>
                    <div class="flex justify-between items-center">
                        <span class="text-red-600 font-bold">$<?php echo e(number_format($product->price, 2)); ?></span>
                        <div class="flex space-x-2">
                            <span class="quick-view-stock" style="display: none"><?php echo e($product->amount); ?></span>

                            <button class="wishlist-button text-gray-400 hover:text-red-600 transition-colors" onclick="addToWishlist(this)">
                                <i class="fas fa-heart"></i>
                            </button>
                            <a href="<?php echo e(route('product.show', $product->mp_id)); ?>" class="quick-view-button bg-gray-100 text-gray-700 px-4 py-2 rounded hover:bg-gray-200 transition-colors">
                                <i class="fas fa-eye"></i>
                            </a>
                            <button class="cart-button bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors" onclick="addToCart(this)">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

</div>

<!-- Cart Preview -->
<div class="cart-preview" id="cart-preview">
    <h3 class="text-lg font-semibold mb-4">Your Cart</h3>
    <div id="cart-items" class="space-y-4">
        <!-- Cart items will be loaded here -->
    </div>
    <div class="mt-4 pt-4 border-t">
        <div class="flex justify-between font-semibold">
            <span>Total:</span>
            <span id="cart-total">$0.00</span>
        </div>
        <button class="w-full bg-red-600 text-white py-2 rounded mt-4 hover:bg-red-700 transition-colors">
            Checkout
        </button>
    </div>
</div>

<!-- Notification -->
<div class="notification" id="notification">
    <div class="flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        <span id="notification-message">Item added to cart!</span>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    :root {
        --gradient-primary: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        --gradient-secondary: linear-gradient(135deg, #fb923c 0%, #f97316 100%);
        --gradient-accent: linear-gradient(135deg, #fdba74 0%, #fb923c 100%);
        --gradient-light: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
        --gradient-warm: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        --gradient-sunset: linear-gradient(135deg, #f97316 0%, #f59e0b 50%, #fbbf24 100%);
    }
    .product-card {
        transition: all 0.3s ease;
        background: var(--gradient-light);
    }
    .product-card:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 10px 20px rgba(249, 115, 22, 0.2);
        background: var(--gradient-warm);
    }
    .gradient-text {
        background: var(--gradient-sunset);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .notification {
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 25px;
        background: var(--gradient-sunset);
        color: white;
        border-radius: 5px;
        transform: translateX(120%);
        transition: transform 0.3s ease;
        z-index: 1000;
    }
    .notification.show {
        transform: translateX(0);
    }
    .cart-preview {
        position: fixed;
        top: 80px;
        right: 20px;
        width: 300px;
        background: var(--gradient-warm);
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transform: translateX(120%);
        transition: transform 0.3s ease;
        z-index: 1000;
        padding: 20px;
    }
    .cart-preview.show {
        transform: translateX(0);
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    let cart = [];
let wishlist = [];

function showNotification(message, type = 'success') {
    const notification = document.getElementById('notification');
    const notificationMessage = document.getElementById('notification-message');
    notificationMessage.textContent = message;
    notification.classList.add('show');
    setTimeout(() => {
        notification.classList.remove('show');
    }, 3000);
}

function updateCartCount() {
    const cartCount = document.getElementById('cart-count');
    if (cartCount) cartCount.textContent = cart.length;
}

function updateWishlistCount() {
    const wishlistCount = document.getElementById('wishlist-count');
    if (wishlistCount) wishlistCount.textContent = wishlist.length;
}

function addToCart(button) {
    const card = button.closest('.product-card');
    const product = {
        id: card.dataset.mall,
        name: card.querySelector('h3').textContent,
        price: parseFloat(card.querySelector('.text-red-600').textContent.replace('$', '')),
        image: card.querySelector('img').src
    };
    cart.push(product);
    updateCartCount();
    showNotification(`${product.name} added to cart!`);
}

function addToWishlist(button) {
    const card = button.closest('.product-card');
    const product = {
        id: card.querySelector('input[type="text"]').value, // Get the product ID from the hidden input
        name: card.querySelector('h3').textContent
    };

    // Check if the product is already in the wishlist
    const existingProductIndex = wishlist.findIndex(item => item.id === product.id);

    if (existingProductIndex === -1) {
        // Product is not in the wishlist, add it
        wishlist.push(product);
        button.classList.remove('text-gray-400');
        button.classList.add('text-red-600');
        showNotification(`${product.name} added to wishlist!`);
    } else {
        // Product is in the wishlist, remove it
        wishlist.splice(existingProductIndex, 1);
        button.classList.remove('text-red-600');
        button.classList.add('text-gray-400');
        showNotification(`${product.name} removed from wishlist!`);
    }

    updateWishlistCount();
}

// Initialize animate.css classes
document.querySelectorAll('.product-card').forEach(card => {
    card.classList.add('animate__animated', 'animate__fadeIn');
});

    </script>

<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\AA7\Desktop\programming\Laravel\mall---v4\mall\resources\views/products.blade.php ENDPATH**/ ?>