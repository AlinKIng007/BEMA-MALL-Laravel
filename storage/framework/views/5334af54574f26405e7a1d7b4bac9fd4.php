<?php
$amount = 0;
$subtotal = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - City Center Mall</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --gradient-primary: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
            --gradient-secondary: linear-gradient(135deg, #fb923c 0%, #f97316 100%);
            --gradient-accent: linear-gradient(135deg, #fdba74 0%, #fb923c 100%);
            --gradient-light: linear-gradient(135deg, #fff7ed 0%, #ffedd5 100%);
            --gradient-warm: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
            --gradient-sunset: linear-gradient(135deg, #f97316 0%, #f59e0b 50%, #fbbf24 100%);
        }
        @keyframes glow {
            0% { box-shadow: 0 0 5px rgba(249, 115, 22, 0.5); }
            50% { box-shadow: 0 0 20px rgba(249, 115, 22, 0.8); }
            100% { box-shadow: 0 0 5px rgba(249, 115, 22, 0.5); }
        }
        @keyframes pulse-orange {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .glow-effect {
            animation: glow 2s infinite;
        }
        .pulse-orange {
            animation: pulse-orange 2s infinite;
        }
        .cart-item {
            transition: all 0.3s ease;
        }
        .cart-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(249, 115, 22, 0.1);
        }
        .quantity-btn {
            transition: all 0.3s ease;
        }
        .quantity-btn:hover {
            transform: scale(1.1);
            background: var(--gradient-sunset);
            color: white;
        }
        .remove-btn {
            transition: all 0.3s ease;
        }
        .remove-btn:hover {
            transform: scale(1.1);
            color: #ef4444;
        }
        .checkout-btn {
            transition: all 0.3s ease;
            background-color: #ea580c !important;
        }
        .checkout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(249, 115, 22, 0.2);
            background-color: #c2410c !important;
        }
    </style>
</head>
<body class="bg-orange-50 min-h-screen">
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Main Content -->
    <main class="container mx-auto px-6 pt-24 pb-12">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Your Shopping Cart</h1>

        <!-- Cart Items -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div id="cart-items" class="space-y-4">

<?php if($results->isEmpty()): ?>
    <div class="text-center py-8">
        <i class="fas fa-shopping-cart text-4xl text-gray-400 mb-4"></i>
        <p class="text-gray-600">Your cart is empty</p>
    </div>
<?php else: ?>
    <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="cart-item flex items-center justify-between p-4 border-b">
            <div class="flex items-center space-x-4">
                <img src="images/<?php echo e($result->image_1); ?>" alt="<?php echo e($result->product_name); ?>" class="w-20 h-20 object-cover rounded-lg">
                <div>
                    <h3 class="font-semibold text-gray-800"><?php echo e($result->product_name); ?></h3>
                    <p class="text-sm text-gray-600"><?php echo e($result->description); ?></p>
                    <p class="text-orange-600 font-semibold">$<?php echo e(number_format($result->price, 2)); ?></p>
</div>
                    <!-- Loop through each variation and display in a separate div -->
                    <?php
                        $variations = explode(',', $result->variation_values);
                    ?>
    <div></div>
                    <?php $__currentLoopData = $variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div>
                        <div class="variation-item text-sm text-gray-600">
                            <p>Variation: <?php echo e(trim($variation)); ?></p>
                        </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>
            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2">
                    <span id="cart-amount:<?php echo e($result->id); ?>" class="w-8 text-center"><?php echo e($result->amount); ?></span>
                </div>
                <form action="<?php echo e(url('cart/delete')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" value="<?php echo e($result->id); ?>">
                    <button class="remove-btn text-gray-400 hover:text-red-500">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        <?php
        $subtotal = $result->amount * $result->price;
        $amount += 1;
        ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>





            </div>
        </div>

        <!-- Cart Summary -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-4">
                <span class="text-lg font-semibold text-gray-700">Subtotal:</span>
                <span id="subtotal" class="text-xl font-bold text-orange-600">$<?php echo e($subtotal); ?></span>
            </div>
            <div class="flex justify-between items-center mb-4">
                <span class="text-lg font-semibold text-gray-700">Shipping:</span>
                <span class="text-xl font-bold text-orange-600">$<?php echo e($amount *  2.5); ?></span>
            </div>
            <div class="flex justify-between items-center mb-6">
                <span class="text-lg font-semibold text-gray-700">Total:</span>
                <span id="total" class="text-2xl font-bold text-orange-600">$<?php echo e($subtotal +($amount*2.5)); ?></span>
            </div>
            <?php if($amount > 0): ?>


            <button onclick="checkout()" class="w-full bg-orange-600 text-white py-3 rounded-lg font-semibold checkout-btn hover:bg-orange-700 transition-colors">
                Proceed to Checkout
            </button>
            <?php endif; ?>
        </div>
    </main>

    <script>
        // // Sample cart data
        // const cartProducts = [
        //     {
        //         id: 1,
        //         name: "Latest Smartphone",
        //         description: "High-performance smartphone with advanced camera and long battery life",
        //         price: 899.99,
        //         image: "https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
        //         category: "electronics",
        //         quantity: 1
        //     },
        //     {
        //         id: 2,
        //         name: "Designer Sunglasses",
        //         description: "Premium sunglasses with UV protection and stylish design",
        //         price: 199.99,
        //         image: "https://images.unsplash.com/photo-1572635196237-14b3f281503f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
        //         category: "accessories",
        //         quantity: 2
        //     }
        // ];

        // // Load cart from localStorage or use sample data
        // let cart = JSON.parse(localStorage.getItem('cart')) || cartProducts;

        // // Function to update cart display
        // function updateCart() {
        //     const cartItems = document.getElementById('cart-items');
        //     const subtotal = document.getElementById('subtotal');
        //     const total = document.getElementById('total');

        //     // if (cart.length === 0) {
        //     //     cartItems.innerHTML = `
        //     //         <div class="text-center py-8">
        //     //             <i class="fas fa-shopping-cart text-4xl text-gray-400 mb-4"></i>
        //     //             <p class="text-gray-600">Your cart is empty</p>
        //     //         </div>
        //     //     `;
        //     //     subtotal.textContent = '$0.00';
        //     //     total.textContent = '$0.00';
        //     //     return;
        //     // }

        //     let cartHTML = '';
        //     let cartSubtotal = 0;

        //     cart.forEach(item => {
        //         const itemTotal = item.price * item.quantity;
        //         cartSubtotal += itemTotal;

        //         cartHTML += `
        //             <div class="cart-item flex items-center justify-between p-4 border-b">
        //                 <div class="flex items-center space-x-4">
        //                     <img src="${item.image}" alt="${item.name}" class="w-20 h-20 object-cover rounded-lg">
        //                     <div>
        //                         <h3 class="font-semibold text-gray-800">${item.name}</h3>
        //                         <p class="text-sm text-gray-600">${item.description}</p>
        //                         <p class="text-orange-600 font-semibold">$${item.price.toFixed(2)}</p>
        //                     </div>
        //                 </div>
        //                 <div class="flex items-center space-x-4">
        //                     <div class="flex items-center space-x-2">
        //                         <button onclick="updateQuantity(${item.id}, -1)" class="quantity-btn w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
        //                             <i class="fas fa-minus text-gray-600"></i>
        //                         </button>
        //                         <span class="w-8 text-center">${item.quantity}</span>
        //                         <button onclick="updateQuantity(${item.id}, 1)" class="quantity-btn w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
        //                             <i class="fas fa-plus text-gray-600"></i>
        //                         </button>
        //                     </div>
        //                     <button onclick="removeFromCart(${item.id})" class="remove-btn text-gray-400 hover:text-red-500">
        //                         <i class="fas fa-trash"></i>
        //                     </button>
        //                 </div>
        //             </div>
        //         `;
        //     });

        //     cartItems.innerHTML = cartHTML;
        //     subtotal.textContent = `$${cartSubtotal.toFixed(2)}`;
        //     total.textContent = `$${cartSubtotal.toFixed(2)}`;
        // }

        // Function to update item quantity
        function updateQuantity(productId, change,max) {
    const cartElement = document.getElementById("cart-amount:" + productId);
    let currentAmount = parseInt(cartElement.innerText);

    if (isNaN(currentAmount)) currentAmount = 0;

    const newAmount = currentAmount + change;

    // Prevent quantity from going below 1
    if (newAmount < 1 || newAmount > max) return;

    cartElement.innerText = newAmount;

    // Optionally, you could send an AJAX request here to update the backend
}


        // Function to remove item from cart
        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCart();
        }

        // Function to handle checkout
function checkout() {

        // Cart is not empty, redirect to the orders page
        window.location.href = '/orderadd';  // This will take the user to the /orders page

}

        // Initialize cart display
        document.addEventListener('DOMContentLoaded', function() {
            updateCart();
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\AA7\Desktop\programming\Laravel\mall---v6\mall\resources\views/cart.blade.php ENDPATH**/ ?>