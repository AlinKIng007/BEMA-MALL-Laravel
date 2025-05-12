<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Wishlist - City Center Mall</title>
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
        .wishlist-item {
            transition: all 0.3s ease;
        }
        .wishlist-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(249, 115, 22, 0.1);
        }
        .action-btn {
            transition: all 0.3s ease;
            background-color: #ea580c !important;
        }
        .action-btn:hover {
            transform: scale(1.1);
            background-color: #c2410c !important;
            color: white;
        }
        .remove-btn {
            transition: all 0.3s ease;
        }
        .remove-btn:hover {
            transform: scale(1.1);
            color: #ef4444;
        }
    </style>
</head>
<body class="bg-orange-50 min-h-screen">
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Main Content -->
    <main class="container mx-auto px-6 pt-24 pb-12">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Your Wishlist</h1>
        
        <!-- Wishlist Items -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <div id="wishlist-items" class="space-y-4">
                <!-- Wishlist items will be loaded here -->
            </div>
        </div>
    </main>

    <script>
        // Sample wishlist data
        const wishlistProducts = [
            {
                id: 1,
                name: "Premium Headphones",
                description: "Noise-cancelling wireless headphones with premium sound quality",
                price: 199.99,
                image: "https://images.unsplash.com/photo-1505740420928-5e560fc06d30?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                category: "electronics"
            },
            {
                id: 2,
                name: "Luxury Watch",
                description: "Elegant timepiece with premium materials and craftsmanship",
                price: 599.99,
                image: "https://images.unsplash.com/photo-1549923746-162c5684206e?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                category: "accessories"
            }
        ];

        // Load wishlist from localStorage or use sample data
        let wishlist = JSON.parse(localStorage.getItem('wishlist')) || wishlistProducts;

        // Function to update wishlist display
        function updateWishlist() {
            const wishlistItems = document.getElementById('wishlist-items');
            
            if (wishlist.length === 0) {
                wishlistItems.innerHTML = `
                    <div class="text-center py-8">
                        <i class="fas fa-heart text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">Your wishlist is empty</p>
                    </div>
                `;
                return;
            }

            let wishlistHTML = '';

            wishlist.forEach(item => {
                wishlistHTML += `
                    <div class="wishlist-item flex items-center justify-between p-4 border-b">
                        <div class="flex items-center space-x-4">
                            <img src="${item.image}" alt="${item.name}" class="w-20 h-20 object-cover rounded-lg">
                            <div>
                                <h3 class="font-semibold text-gray-800">${item.name}</h3>
                                <p class="text-sm text-gray-600">${item.description}</p>
                                <p class="text-orange-600 font-semibold">$${item.price.toFixed(2)}</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <button onclick="addToCart(${item.id})" class="action-btn text-white px-4 py-2 rounded-lg">
                                Add to Cart
                            </button>
                            <button onclick="removeFromWishlist(${item.id})" class="remove-btn text-gray-400 hover:text-red-500">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
            });

            wishlistItems.innerHTML = wishlistHTML;
        }

        // Function to add item to cart
        function addToCart(productId) {
            const item = wishlist.find(item => item.id === productId);
            if (item) {
                // Here you would typically add the item to the cart
                alert(`${item.name} added to cart!`);
            }
        }

        // Function to remove item from wishlist
        function removeFromWishlist(productId) {
            wishlist = wishlist.filter(item => item.id !== productId);
            localStorage.setItem('wishlist', JSON.stringify(wishlist));
            updateWishlist();
        }

        // Initialize wishlist display
        document.addEventListener('DOMContentLoaded', function() {
            updateWishlist();
        });
    </script>
</body>
</html> <?php /**PATH C:\Users\bahaa\OneDrive\Desktop\laravel\mall\resources\views/wishlist.blade.php ENDPATH**/ ?>