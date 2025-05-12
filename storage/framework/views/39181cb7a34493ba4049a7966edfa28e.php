

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold gradient-text">Products</h1>
    
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="product-card rounded-lg shadow-md overflow-hidden animate__animated animate__fadeIn" data-mall="<?php echo e($product->mall_id); ?>">
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
                            <button class="quick-view-button bg-gray-100 text-gray-700 px-4 py-2 rounded hover:bg-gray-200 transition-colors" onclick="showQuickView(this)">
                                <i class="fas fa-eye"></i>
                            </button>
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

<!-- Quick View Modal -->
<div class="quick-view" id="quick-view">
    <div class="quick-view-content">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
            <div class="relative">
                <img id="quick-view-image" src="" alt="" class="w-full h-96 object-cover rounded-lg">
                <button class="absolute top-4 right-4 bg-white p-2 rounded-full shadow-lg hover:bg-gray-100" onclick="closeQuickView()">
                    <i class="fas fa-times text-gray-600"></i>
                </button>
            </div>
            <div>
                <h2 id="quick-view-title" class="text-2xl font-bold mb-4"></h2>
                <p id="quick-view-price" class="text-2xl font-bold text-red-600 mb-4"></p>
                <p id="quick-view-description" class="text-gray-600 mb-6"></p>
                
                <!-- Stock and Rating -->
                <div class="flex justify-between items-center mb-6">
                    <span id="quick-view-stock" class="text-green-600"></span>
                    <div id="quick-view-rating"></div>
                </div>

                <?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <!-- Color Filter -->
                <div class="mb-6">
                    <h3 class="font-semibold mb-2">Color</h3>
                    <div class="flex space-x-2">
                        <button class="w-8 h-8 rounded-full border-2 border-transparent hover:border-gray-400 transition-colors focus:outline-none focus:border-gray-600" style="background-color: #000000;" onclick="selectColor('Black', this)"></button>
                        <button class="w-8 h-8 rounded-full border-2 border-transparent hover:border-gray-400 transition-colors focus:outline-none focus:border-gray-600" style="background-color: #FFFFFF; border-color: #E5E7EB;" onclick="selectColor('White', this)"></button>
                        <button class="w-8 h-8 rounded-full border-2 border-transparent hover:border-gray-400 transition-colors focus:outline-none focus:border-gray-600" style="background-color: #DC2626;" onclick="selectColor('Red', this)"></button>
                        <button class="w-8 h-8 rounded-full border-2 border-transparent hover:border-gray-400 transition-colors focus:outline-none focus:border-gray-600" style="background-color: #2563EB;" onclick="selectColor('Blue', this)"></button>
                        <button class="w-8 h-8 rounded-full border-2 border-transparent hover:border-gray-400 transition-colors focus:outline-none focus:border-gray-600" style="background-color: #059669;" onclick="selectColor('Green', this)"></button>
                    </div>
                    <p id="selected-color" class="text-sm text-gray-600 mt-2">Selected: None</p>
                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                

                <!-- Quantity -->
                <div class="mb-6">
                    <h3 class="font-semibold mb-2">Quantity</h3>
                    <div class="flex items-center space-x-4">
                        <button class="bg-gray-100 p-2 rounded hover:bg-gray-200" onclick="updateQuantity(-1)">
                            <i class="fas fa-minus"></i>
                        </button>
                        <span id="quantity" class="text-xl">1</span>
                        <button class="bg-gray-100 p-2 rounded hover:bg-gray-200" onclick="updateQuantity(1)">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <button class="w-full bg-red-600 text-white py-3 rounded-lg hover:bg-red-700 transition-colors" onclick="addToCartFromQuickView()">
                    Add to Cart
                </button>
            </div>
        </div>
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
    .quick-view {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 2000;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }
    .quick-view.show {
        opacity: 1;
        visibility: visible;
    }
    .quick-view-content {
        background: var(--gradient-warm);
        width: 90%;
        max-width: 800px;
        border-radius: 10px;
        transform: scale(0.9);
        transition: transform 0.3s ease;
    }
    .quick-view.show .quick-view-content {
        transform: scale(1);
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
        id: card.dataset.mall,
        name: card.querySelector('h3').textContent
    };
    if (!wishlist.some(item => item.id === product.id)) {
        wishlist.push(product);
        button.classList.remove('text-gray-400');
        button.classList.add('text-red-600');
        updateWishlistCount();
        showNotification(`${product.name} added to wishlist!`);
    }
}

function showQuickView(button) {
    const card = button.closest('.product-card');
    const quickView = document.getElementById('quick-view');
    const image = card.querySelector('img').src;
    const title = card.querySelector('h3').textContent;
    const price = card.querySelector('.text-red-600').textContent;
    const description = card.querySelector('p').textContent;
    const amount = card.querySelector('.quick-view-stock').textContent;


    document.getElementById('quick-view-image').src = image;
    document.getElementById('quick-view-title').textContent = title;
    document.getElementById('quick-view-price').textContent = price;
    document.getElementById('quick-view-description').textContent = description;

    document.getElementById('quick-view-stock').textContent = amount > 0 ? amount : 'Out of Stock';;
    document.getElementById('quantity').textContent = '1';
    
    // Reset filters
    document.getElementById('selected-color').textContent = 'Selected: None';
    document.getElementById('selected-size').textContent = 'Selected: None';
    document.querySelectorAll('.size-button').forEach(btn => {
        btn.classList.remove('bg-orange-50', 'border-orange-500');
    });
    document.querySelectorAll('[onclick^="selectColor"]').forEach(btn => {
        btn.classList.remove('border-gray-600');
    });

    quickView.classList.add('show');
}

function closeQuickView() {
    document.getElementById('quick-view').classList.remove('show');
}

function updateQuantity(change) {
    const quantityElement = document.getElementById('quantity');
    let quantity = parseInt(quantityElement.textContent);
    quantity = Math.max(1, Math.min(quantity + change, 10));
    quantityElement.textContent = quantity;
}

function selectColor(color, button) {
    // Remove active state from all color buttons
    document.querySelectorAll('[onclick^="selectColor"]').forEach(btn => {
        btn.classList.remove('border-gray-600');
    });
    
    // Add active state to selected button
    button.classList.add('border-gray-600');
    document.getElementById('selected-color').textContent = `Selected: ${color}`;
}

function selectSize(size, button) {
    // Remove active state from all size buttons
    document.querySelectorAll('.size-button').forEach(btn => {
        btn.classList.remove('bg-orange-50', 'border-orange-500');
    });
    
    // Add active state to selected button
    button.classList.add('bg-orange-50', 'border-orange-500');
    document.getElementById('selected-size').textContent = `Selected: ${size}`;
}

function addToCartFromQuickView() {
    const title = document.getElementById('quick-view-title').textContent;
    const price = parseFloat(document.getElementById('quick-view-price').textContent.replace('$', ''));
    const image = document.getElementById('quick-view-image').src;
    const quantity = parseInt(document.getElementById('quantity').textContent);
    const color = document.getElementById('selected-color').textContent.replace('Selected: ', '');
    const size = document.getElementById('selected-size').textContent.replace('Selected: ', '');

    if (color === 'None' || size === 'None') {
        showNotification('Please select both color and size', 'error');
        return;
    }

    for (let i = 0; i < quantity; i++) {
        cart.push({ 
            name: title, 
            price, 
            image,
            color,
            size
        });
    }
    updateCartCount();
    closeQuickView();
    showNotification(`${quantity} x ${title} (${color}, ${size}) added to cart!`);
}

// Initialize animate.css classes
document.querySelectorAll('.product-card').forEach(card => {
    card.classList.add('animate__animated', 'animate__fadeIn');
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\AA7\Desktop\programming\Laravel\mall\resources\views/products.blade.php ENDPATH**/ ?>