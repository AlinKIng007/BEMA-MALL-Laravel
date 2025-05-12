<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City Center Mall</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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
        @keyframes slide-in {
            from { transform: translateX(-100%); }
            to { transform: translateX(0); }
        }
        .glow-effect {
            animation: glow 2s infinite;
        }
        .pulse-orange {
            animation: pulse-orange 2s infinite;
        }
        .slide-in {
            animation: slide-in 0.5s ease-out;
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
        .category-card {
            transition: all 0.3s ease;
            background: var(--gradient-light);
        }
        .category-card:hover {
            transform: scale(1.05);
            background: var(--gradient-sunset);
            color: white;
        }
        .offer-card {
            transition: all 0.3s ease;
            background: var(--gradient-light);
        }
        .offer-card:hover {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(249, 115, 22, 0.2);
            background: var(--gradient-warm);
        }
        .search-bar {
            transition: all 0.3s ease;
        }
        .search-bar:focus-within {
            transform: scale(1.02);
            box-shadow: 0 5px 15px rgba(249, 115, 22, 0.2);
            background: var(--gradient-warm);
        }
        .nav-link {
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: var(--gradient-sunset);
            transition: width 0.3s ease;
        }
        .nav-link:hover::after {
            width: 100%;
        }
        .pagination-link {
            transition: all 0.3s ease;
        }
        .pagination-link:hover {
            transform: scale(1.1);
            background: var(--gradient-sunset);
            color: white;
        }
        .cart-button {
            transition: all 0.3s ease;
        }
        .cart-button:hover {
            transform: scale(1.05);
            animation: pulse-orange 1s infinite;
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
        .color-swatch {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        .color-swatch:hover {
            transform: scale(1.1);
        }
        .color-swatch.selected {
            border: 2px solid #f97316;
            animation: pulse-orange 1s infinite;
        }
        .size-option {
            padding: 8px 16px;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .size-option:hover {
            background: var(--gradient-warm);
        }
        .size-option.selected {
            background: var(--gradient-sunset);
            color: white;
            border-color: #f97316;
        }
        .gradient-text {
            background: var(--gradient-sunset);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .gradient-bg {
            background: var(--gradient-sunset);
        }
        .gradient-button {
            background: var(--gradient-sunset);
            color: white;
            transition: all 0.3s ease;
        }
        .gradient-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(249, 115, 22, 0.3);
            animation: pulse-orange 1s infinite;
        }
        .gradient-border {
            border: 2px solid transparent;
            background: linear-gradient(white, white) padding-box,
                        var(--gradient-sunset) border-box;
        }
        .warm-accent {
            background: var(--gradient-warm);
            transition: all 0.3s ease;
        }
        .warm-accent:hover {
            background: var(--gradient-sunset);
            color: white;
        }
        .hero-section {
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--gradient-sunset);
            opacity: 0.8;
            z-index: 1;
        }
        .hero-content {
            position: relative;
            z-index: 2;
        }
    </style>
</head>
<body class="bg-orange-50">
    <?php echo $__env->make('partials.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Search Bar -->
    <div class="gradient-bg py-4 pt-24">
        <div class="container mx-auto px-6">
            <div class="max-w-2xl mx-auto">
                <div class="relative search-bar">
                    <input type="text" placeholder="Search products, stores, or categories..." 
                           class="w-full px-4 py-3 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-300">
                    <button class="absolute right-3 top-3 text-gray-500 hover:text-white transition-colors">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <section class="hero-section text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-black opacity-20"></div>
        <div class="container mx-auto px-6 py-20 relative hero-content">
            <div class="flex flex-col items-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 animate__animated animate__fadeInDown">Welcome to City Center Mall</h1>
                <p class="text-xl mb-8 text-center max-w-2xl animate__animated animate__fadeInUp animate__delay-1s">Your premier shopping destination with over 200 stores, entertainment, and dining options.</p>
                <button class="gradient-button px-8 py-3 rounded-full font-semibold hover:bg-orange-50 transition duration-300 animate__animated animate__pulse animate__infinite">Explore Stores</button>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-8 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-2xl font-bold mb-6 gradient-text animate__animated animate__fadeIn">Shop by Category</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="category-card p-4 rounded-lg text-center cursor-pointer">
                    <i class="fas fa-tshirt text-3xl mb-2 gradient-text"></i>
                    <p>Fashion</p>
                </div>
                <div class="category-card p-4 rounded-lg text-center cursor-pointer">
                    <i class="fas fa-mobile-alt text-3xl mb-2 gradient-text"></i>
                    <p>Electronics</p>
                </div>
                <div class="category-card p-4 rounded-lg text-center cursor-pointer">
                    <i class="fas fa-home text-3xl mb-2 gradient-text"></i>
                    <p>Home & Living</p>
                </div>
                <div class="category-card p-4 rounded-lg text-center cursor-pointer">
                    <i class="fas fa-utensils text-3xl mb-2 gradient-text"></i>
                    <p>Food & Dining</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Special Offers Section -->
    <section class="py-8 bg-orange-50">
        <div class="container mx-auto px-6">
            <h2 class="text-2xl font-bold mb-6 gradient-text animate__animated animate__fadeIn">Special Offers</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="offer-card p-6 rounded-lg shadow-md floating">
                    <div class="gradient-text font-bold mb-2">Weekend Special</div>
                    <h3 class="text-xl font-semibold mb-2">20% Off All Electronics</h3>
                    <p class="text-gray-600">Valid until Sunday</p>
                </div>
                <div class="offer-card p-6 rounded-lg shadow-md floating" style="animation-delay: 0.2s">
                    <div class="gradient-text font-bold mb-2">New Arrivals</div>
                    <h3 class="text-xl font-semibold mb-2">Summer Collection</h3>
                    <p class="text-gray-600">Check out our latest fashion</p>
                </div>
                <div class="offer-card p-6 rounded-lg shadow-md floating" style="animation-delay: 0.4s">
                    <div class="gradient-text font-bold mb-2">Dining Deal</div>
                    <h3 class="text-xl font-semibold mb-2">Buy 1 Get 1 Free</h3>
                    <p class="text-gray-600">At selected restaurants</p>
                </div>
            </div>
        </div>
    </section>

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
            <button class="w-full bg-teal-600 text-white py-2 rounded mt-4 hover:bg-teal-700 transition-colors">
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
                    
                    <!-- Features -->
                    <div class="mb-6">
                        <h3 class="font-semibold mb-2">Features</h3>
                        <ul id="quick-view-features" class="space-y-2"></ul>
                    </div>

                    <!-- Specifications -->
                    <div class="mb-6">
                        <h3 class="font-semibold mb-2">Specifications</h3>
                        <div id="quick-view-specs" class="space-y-2"></div>
                    </div>

                    <!-- Color Selection -->
                    <div class="mb-6">
                        <h3 class="font-semibold mb-2">Color</h3>
                        <div id="quick-view-colors" class="flex space-x-4"></div>
                    </div>

                    <!-- Size Selection -->
                    <div class="mb-6">
                        <h3 class="font-semibold mb-2">Size</h3>
                        <div id="quick-view-sizes" class="flex space-x-4"></div>
                    </div>

                    <!-- Stock and Rating -->
                    <div class="flex justify-between items-center mb-6">
                        <span id="quick-view-stock" class="text-green-600"></span>
                        <div id="quick-view-rating"></div>
                    </div>

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

    <!-- Featured Products Section -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12 animate__animated animate__fadeIn">Featured Products</h2>
            
            <!-- Filter Section -->
            <div class="mb-8 flex flex-wrap gap-4 justify-center">
                <button class="filter-btn px-4 py-2 rounded-full bg-teal-600 text-white" data-category="all">All</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 hover:bg-teal-600 hover:text-white transition-colors" data-category="electronics">Electronics</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 hover:bg-teal-600 hover:text-white transition-colors" data-category="fashion">Fashion</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 hover:bg-teal-600 hover:text-white transition-colors" data-category="accessories">Accessories</button>
            </div>

            <!-- Loading Spinner -->
            <div class="flex justify-center my-8 hidden" id="loading-spinner">
                <div class="loading-spinner"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8" id="products-container">
                <!-- Products will be loaded here -->
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12">
                <nav class="flex items-center space-x-2" id="pagination">
                    <!-- Pagination will be generated here -->
                </nav>
            </div>
        </div>
    </section>

    <!-- Mall Information Section -->
    <section class="bg-gray-50 py-16">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-8 md:mb-0 animate__animated animate__fadeInLeft">
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" alt="Mall Interior" class="rounded-lg shadow-lg">
                </div>
                <div class="md:w-1/2 md:pl-12 animate__animated animate__fadeInRight">
                    <h2 class="text-3xl font-bold mb-6">About City Center Mall</h2>
                    <p class="text-gray-600 mb-4">City Center Mall is the largest shopping destination in the region, offering a unique shopping experience with over 200 stores, 50 restaurants, and entertainment options for the whole family.</p>
                    <p class="text-gray-600 mb-4">Our mall features state-of-the-art facilities, including free WiFi, ample parking, and a dedicated family area. We pride ourselves on providing excellent customer service and a comfortable environment for all our visitors.</p>
                    <div class="grid grid-cols-2 gap-4 mt-8">
                        <div class="flex items-center">
                            <i class="fas fa-store text-teal-600 text-2xl mr-3"></i>
                            <span>200+ Stores</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-utensils text-red-600 text-2xl mr-3"></i>
                            <span>50+ Restaurants</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-parking text-red-600 text-2xl mr-3"></i>
                            <span>Free Parking</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-wifi text-red-600 text-2xl mr-3"></i>
                            <span>Free WiFi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">City Center Mall</h3>
                    <p class="text-gray-400">Your premier shopping destination</p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Home</a></li>
                        <li><a href="/products" class="text-gray-400 hover:text-white transition-colors">Products</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">About</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Us</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span class="text-gray-400">123 Mall Street, Downtown</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2"></i>
                            <span class="text-gray-400">+1 (555) 123-4567</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2"></i>
                            <span class="text-gray-400">info@citycentermall.com</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2024 City Center Mall. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Enhanced product data with more details
        const products = [
            {
                id: 1,
                name: "Smart Watch Pro",
                description: "Latest smartwatch with health monitoring and fitness tracking features. Water-resistant up to 50m, 7-day battery life, and AMOLED display.",
                price: 299.99,
                image: "https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                category: "electronics",
                features: [
                    "Heart rate monitoring",
                    "Sleep tracking",
                    "GPS navigation",
                    "Music control",
                    "Water resistant"
                ],
                specifications: {
                    "Display": "1.4\" AMOLED",
                    "Battery": "7 days",
                    "Water Resistance": "50m",
                    "Connectivity": "Bluetooth 5.0",
                    "Compatibility": "iOS & Android"
                },
                colors: ["Black", "Silver", "Gold"],
                sizes: ["One Size"],
                stock: 15,
                rating: 4.8,
                reviews: 128
            },
            {
                id: 2,
                name: "Premium Headphones",
                description: "Noise-cancelling wireless headphones with premium sound quality. 30-hour battery life and comfortable over-ear design.",
                price: 199.99,
                image: "https://images.unsplash.com/photo-1505740420928-5e560fc06d30?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                category: "electronics",
                features: [
                    "Active noise cancellation",
                    "30-hour battery life",
                    "Touch controls",
                    "Built-in microphone",
                    "Foldable design"
                ],
                specifications: {
                    "Driver": "40mm",
                    "Battery": "30 hours",
                    "Weight": "250g",
                    "Connectivity": "Bluetooth 5.0",
                    "Charging": "USB-C"
                },
                colors: ["Black", "White", "Blue"],
                sizes: ["One Size"],
                stock: 25,
                rating: 4.7,
                reviews: 95
            },
            {
                id: 3,
                name: "Latest Smartphone",
                description: "High-performance smartphone with advanced camera and long battery life. 6.7\" AMOLED display and 5G connectivity.",
                price: 899.99,
                image: "https://images.unsplash.com/photo-1546868871-7041f2a55e12?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                category: "electronics",
                features: [
                    "6.7\" AMOLED display",
                    "Triple camera system",
                    "5G connectivity",
                    "Fast charging",
                    "In-display fingerprint"
                ],
                specifications: {
                    "Processor": "Snapdragon 8 Gen 2",
                    "RAM": "12GB",
                    "Storage": "256GB",
                    "Battery": "5000mAh",
                    "OS": "Android 13"
                },
                colors: ["Black", "White", "Green"],
                sizes: ["128GB", "256GB", "512GB"],
                stock: 10,
                rating: 4.9,
                reviews: 210
            },
            {
                id: 4,
                name: "Designer Sunglasses",
                description: "Premium sunglasses with UV protection and stylish design. Lightweight frame and polarized lenses.",
                price: 199.99,
                image: "https://images.unsplash.com/photo-1572635196237-14b3f281503f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                category: "accessories",
                features: [
                    "UV400 protection",
                    "Polarized lenses",
                    "Lightweight frame",
                    "Scratch resistant",
                    "Comfortable fit"
                ],
                specifications: {
                    "Lens Material": "Polycarbonate",
                    "Frame Material": "Acetate",
                    "Lens Width": "55mm",
                    "Bridge Width": "18mm",
                    "Temple Length": "145mm"
                },
                colors: ["Black", "Tortoise", "Gold"],
                sizes: ["One Size"],
                stock: 30,
                rating: 4.6,
                reviews: 75
            },
            {
                id: 5,
                name: "Luxury Watch",
                description: "Elegant timepiece with premium materials and craftsmanship. Automatic movement and sapphire crystal.",
                price: 599.99,
                image: "https://images.unsplash.com/photo-1549923746-162c5684206e?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                category: "accessories",
                features: [
                    "Automatic movement",
                    "Sapphire crystal",
                    "Stainless steel case",
                    "Water resistant",
                    "Date display"
                ],
                specifications: {
                    "Movement": "Automatic",
                    "Case Size": "42mm",
                    "Water Resistance": "50m",
                    "Material": "Stainless Steel",
                    "Crystal": "Sapphire"
                },
                colors: ["Silver", "Gold", "Rose Gold"],
                sizes: ["One Size"],
                stock: 8,
                rating: 4.8,
                reviews: 42
            },
            {
                id: 6,
                name: "Running Shoes",
                description: "High-performance running shoes with advanced cushioning technology. Lightweight and breathable design.",
                price: 129.99,
                image: "https://images.unsplash.com/photo-1542291026-7eec264c27ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                category: "fashion",
                features: [
                    "Advanced cushioning",
                    "Breathable mesh",
                    "Lightweight design",
                    "Durable outsole",
                    "Arch support"
                ],
                specifications: {
                    "Weight": "250g",
                    "Drop": "8mm",
                    "Upper": "Mesh",
                    "Midsole": "EVA foam",
                    "Outsole": "Rubber"
                },
                colors: ["Black", "White", "Blue", "Red"],
                sizes: ["US 7", "US 8", "US 9", "US 10", "US 11"],
                stock: 20,
                rating: 4.7,
                reviews: 156
            },
            {
                id: 7,
                name: "Travel Backpack",
                description: "Durable backpack with multiple compartments and laptop sleeve. Water-resistant and comfortable to carry.",
                price: 89.99,
                image: "https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                category: "accessories",
                features: [
                    "Laptop compartment",
                    "Water resistant",
                    "Multiple pockets",
                    "Padded straps",
                    "TSA approved"
                ],
                specifications: {
                    "Capacity": "30L",
                    "Material": "Nylon",
                    "Laptop Size": "Up to 15\"",
                    "Weight": "1.2kg",
                    "Dimensions": "20 x 13 x 8 inches"
                },
                colors: ["Black", "Gray", "Navy"],
                sizes: ["One Size"],
                stock: 35,
                rating: 4.5,
                reviews: 89
            },
            {
                id: 8,
                name: "Ultrabook Pro",
                description: "Lightweight laptop with powerful performance and long battery life. 14\" display and premium build quality.",
                price: 1299.99,
                image: "https://images.unsplash.com/photo-1541125897807-5d5c4c6b0e0e?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                category: "electronics",
                features: [
                    "14\" Retina display",
                    "12-hour battery",
                    "Thunderbolt 4",
                    "Backlit keyboard",
                    "Fingerprint sensor"
                ],
                specifications: {
                    "Processor": "Intel Core i7",
                    "RAM": "16GB",
                    "Storage": "512GB SSD",
                    "Display": "14\" 2560x1600",
                    "Weight": "1.3kg"
                },
                colors: ["Space Gray", "Silver"],
                sizes: ["16GB/512GB", "16GB/1TB"],
                stock: 12,
                rating: 4.9,
                reviews: 178
            },
            {
                id: 9,
                name: "Professional Camera",
                description: "High-resolution camera with advanced features for professional photography. 4K video and fast autofocus.",
                price: 1499.99,
                image: "https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                category: "electronics",
                features: [
                    "24MP sensor",
                    "4K video",
                    "Fast autofocus",
                    "Weather sealed",
                    "Dual card slots"
                ],
                specifications: {
                    "Sensor": "24MP APS-C",
                    "Video": "4K 30fps",
                    "ISO": "100-51200",
                    "Autofocus": "425 points",
                    "Weight": "650g"
                },
                colors: ["Black"],
                sizes: ["Body Only", "With 18-55mm Lens"],
                stock: 6,
                rating: 4.8,
                reviews: 64
            }
        ];

        // Cart and Wishlist functionality
        let cart = [];
        let wishlist = [];
        let currentCategory = 'all';
        let itemsPerPage = 6;
        let currentPage = 1;

        // Function to show notification
        function showNotification(message) {
            const notification = document.getElementById('notification');
            const notificationMessage = document.getElementById('notification-message');
            notificationMessage.textContent = message;
            notification.classList.add('show');
            setTimeout(() => {
                notification.classList.remove('show');
            }, 3000);
        }

        // Function to update cart count
        function updateCartCount() {
            const cartCount = document.getElementById('cart-count');
            cartCount.textContent = cart.length;
        }

        // Function to update wishlist count
        function updateWishlistCount() {
            const wishlistCount = document.getElementById('wishlist-count');
            wishlistCount.textContent = wishlist.length;
        }

        // Function to update cart preview
        function updateCartPreview() {
            const cartItems = document.getElementById('cart-items');
            const cartTotal = document.getElementById('cart-total');
            let total = 0;

            cartItems.innerHTML = '';
            cart.forEach(item => {
                total += item.price;
                cartItems.innerHTML += `
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="${item.image}" alt="${item.name}" class="w-12 h-12 object-cover rounded">
                            <div class="ml-3">
                                <h4 class="font-semibold">${item.name}</h4>
                                <p class="text-sm text-gray-600">$${item.price}</p>
                            </div>
                        </div>
                        <button class="text-red-600 hover:text-red-700" onclick="removeFromCart(${item.id})">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
            });

            cartTotal.textContent = `$${total.toFixed(2)}`;
        }

        // Function to add to cart
        function addToCart(product) {
            cart.push(product);
            updateCartCount();
            updateCartPreview();
            showNotification(`${product.name} added to cart!`);
        }

        // Function to remove from cart
        function removeFromCart(productId) {
            cart = cart.filter(item => item.id !== productId);
            updateCartCount();
            updateCartPreview();
            showNotification('Item removed from cart');
        }

        // Function to add to wishlist
        function addToWishlist(product) {
            if (!wishlist.some(item => item.id === product.id)) {
                wishlist.push(product);
                updateWishlistCount();
                showNotification(`${product.name} added to wishlist!`);
            } else {
                showNotification(`${product.name} is already in your wishlist!`);
            }
        }

        // Function to remove from wishlist
        function removeFromWishlist(productId) {
            wishlist = wishlist.filter(item => item.id !== productId);
            updateWishlistCount();
            showNotification('Item removed from wishlist');
        }

        // Function to filter products
        function filterProducts(category) {
            currentCategory = category;
            const filterButtons = document.querySelectorAll('.filter-btn');
            filterButtons.forEach(btn => {
                if (btn.dataset.category === category) {
                    btn.classList.add('bg-red-600', 'text-white');
                    btn.classList.remove('bg-gray-200');
                } else {
                    btn.classList.remove('bg-red-600', 'text-white');
                    btn.classList.add('bg-gray-200');
                }
            });
            displayProducts(currentPage);
        }

        // Function to display products with loading animation
        function displayProducts(page) {
            const container = document.getElementById('products-container');
            const loadingSpinner = document.getElementById('loading-spinner');
            
            container.innerHTML = '';
            loadingSpinner.classList.remove('hidden');

            setTimeout(() => {
                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                let filteredProducts = currentCategory === 'all' 
                    ? products 
                    : products.filter(p => p.category === currentCategory);
                
                const productsToShow = filteredProducts.slice(startIndex, endIndex);

                container.innerHTML = '';
                loadingSpinner.classList.add('hidden');

                productsToShow.forEach((product, index) => {
                    const isInWishlist = wishlist.some(item => item.id === product.id);
                    const productCard = document.createElement('div');
                    productCard.className = 'product-card bg-white rounded-lg shadow-md overflow-hidden animate__animated animate__fadeIn';
                    productCard.style.setProperty('--item-index', index);
                    productCard.innerHTML = `
                        <img src="${product.image}" alt="${product.name}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">${product.name}</h3>
                            <p class="text-gray-600 mb-4">${product.description.substring(0, 100)}...</p>
                            <div class="flex justify-between items-center">
                                <span class="text-red-600 font-bold">$${product.price}</span>
                                <div class="flex space-x-2">
                                    <button class="wishlist-button ${isInWishlist ? 'text-red-600' : 'text-gray-400'} hover:text-red-600 transition-colors" 
                                            onclick="addToWishlist(${JSON.stringify(product).replace(/"/g, '&quot;')})">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <button class="quick-view-button bg-gray-100 text-gray-700 px-4 py-2 rounded hover:bg-gray-200" 
                                            onclick="showQuickView(${product.id})">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="cart-button bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" 
                                            onclick="addToCart(${JSON.stringify(product).replace(/"/g, '&quot;')})">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    container.appendChild(productCard);
                });
            }, 500);
        }

        // Function to generate pagination
        function generatePagination() {
            const totalPages = Math.ceil(
                (currentCategory === 'all' ? products.length : products.filter(p => p.category === currentCategory).length) 
                / itemsPerPage
            );
            const pagination = document.getElementById('pagination');
            pagination.innerHTML = '';

            // Previous button
            if (currentPage > 1) {
                pagination.innerHTML += `
                    <button class="pagination-link px-4 py-2 border rounded-lg hover:bg-red-600 hover:text-white" onclick="changePage(${currentPage - 1})">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                `;
            }

            // Page numbers
            for (let i = 1; i <= totalPages; i++) {
                if (i === currentPage) {
                    pagination.innerHTML += `
                        <button class="pagination-link px-4 py-2 border rounded-lg bg-red-600 text-white">${i}</button>
                    `;
                } else {
                    pagination.innerHTML += `
                        <button class="pagination-link px-4 py-2 border rounded-lg hover:bg-red-600 hover:text-white" onclick="changePage(${i})">${i}</button>
                    `;
                }
            }

            // Next button
            if (currentPage < totalPages) {
                pagination.innerHTML += `
                    <button class="pagination-link px-4 py-2 border rounded-lg hover:bg-red-600 hover:text-white" onclick="changePage(${currentPage + 1})">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                `;
            }
        }

        // Function to change page
        function changePage(page) {
            // Prevent default behavior
            event.preventDefault();
            event.stopPropagation();
            
            currentPage = page;
            displayProducts(currentPage);
            generatePagination();
        }

        // Cart preview toggle
        document.getElementById('cart-button').addEventListener('click', () => {
            document.getElementById('cart-preview').classList.toggle('show');
        });

        // Close cart preview when clicking outside
        document.addEventListener('click', (e) => {
            const cartPreview = document.getElementById('cart-preview');
            const cartButton = document.getElementById('cart-button');
            if (!cartPreview.contains(e.target) && !cartButton.contains(e.target)) {
                cartPreview.classList.remove('show');
            }
        });

        // Initialize the page
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize functionality
            displayProducts(currentPage);
            generatePagination();
        });

        // Function to show quick view
        function showQuickView(productId) {
            const product = products.find(p => p.id === productId);
            const quickView = document.getElementById('quick-view');
            const quickViewContent = document.getElementById('quick-view-content');
            
            // Update quick view content
            document.getElementById('quick-view-image').src = product.image;
            document.getElementById('quick-view-title').textContent = product.name;
            document.getElementById('quick-view-price').textContent = `$${product.price}`;
            document.getElementById('quick-view-description').textContent = product.description;
            
            // Update features
            const featuresList = document.getElementById('quick-view-features');
            featuresList.innerHTML = product.features.map(feature => 
                `<li class="flex items-center mb-2">
                    <i class="fas fa-check text-green-500 mr-2"></i>
                    <span>${feature}</span>
                </li>`
            ).join('');

            // Update specifications
            const specsList = document.getElementById('quick-view-specs');
            specsList.innerHTML = Object.entries(product.specifications).map(([key, value]) => 
                `<div class="flex justify-between py-2 border-b">
                    <span class="text-gray-600">${key}</span>
                    <span class="font-medium">${value}</span>
                </div>`
            ).join('');

            // Update colors
            const colorsContainer = document.getElementById('quick-view-colors');
            colorsContainer.innerHTML = product.colors.map(color => 
                `<div class="color-swatch bg-${color.toLowerCase()} ${color === product.colors[0] ? 'selected' : ''}" 
                      data-color="${color.toLowerCase()}" 
                      onclick="selectColor(this, '${color.toLowerCase()}')"></div>`
            ).join('');

            // Update sizes
            const sizesContainer = document.getElementById('quick-view-sizes');
            sizesContainer.innerHTML = product.sizes.map(size => 
                `<div class="size-option ${size === product.sizes[0] ? 'selected' : ''}" 
                      onclick="selectSize(this, '${size}')">${size}</div>`
            ).join('');

            // Update stock and rating
            document.getElementById('quick-view-stock').textContent = `${product.stock} in stock`;
            document.getElementById('quick-view-rating').innerHTML = `
                <div class="flex items-center">
                    <div class="flex text-yellow-400">
                        ${Array(5).fill().map((_, i) => 
                            `<i class="fas fa-star ${i < Math.floor(product.rating) ? 'text-yellow-400' : 'text-gray-300'}"></i>`
                        ).join('')}
                    </div>
                    <span class="ml-2 text-gray-600">(${product.reviews} reviews)</span>
                </div>
            `;

            // Show quick view
            quickView.classList.add('show');
        }

        // Function to close quick view
        function closeQuickView() {
            document.getElementById('quick-view').classList.remove('show');
        }

        // Function to select color
        function selectColor(element, color) {
            document.querySelectorAll('.color-swatch').forEach(swatch => swatch.classList.remove('selected'));
            element.classList.add('selected');
        }

        // Function to select size
        function selectSize(element, size) {
            document.querySelectorAll('.size-option').forEach(option => option.classList.remove('selected'));
            element.classList.add('selected');
        }

        // Function to update quantity
        function updateQuantity(change) {
            const quantityElement = document.getElementById('quantity');
            let quantity = parseInt(quantityElement.textContent);
            quantity = Math.max(1, Math.min(quantity + change, 10));
            quantityElement.textContent = quantity;
        }

        // Function to add to cart from quick view
        function addToCartFromQuickView() {
            const productId = parseInt(document.getElementById('quick-view-title').dataset.productId);
            const product = products.find(p => p.id === productId);
            const quantity = parseInt(document.getElementById('quantity').textContent);
            
            for (let i = 0; i < quantity; i++) {
                addToCart(product);
            }
            
            closeQuickView();
        }
    </script>
</body>
</html><?php /**PATH C:\Users\AA7\Desktop\mall\resources\views/welcome.blade.php ENDPATH**/ ?>