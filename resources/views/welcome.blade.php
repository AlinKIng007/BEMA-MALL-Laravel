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
        @keyframes float {
            0% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
            100% {
                transform: translateY(0px) rotate(0deg);
            }
        }
        @keyframes rotate3d {
            0% {
                transform: perspective(1000px) rotateY(0deg);
            }
            50% {
                transform: perspective(1000px) rotateY(15deg);
            }
            100% {
                transform: perspective(1000px) rotateY(0deg);
            }
        }
        .floating-headphones {
            animation: float 6s ease-in-out infinite, rotate3d 8s ease-in-out infinite;
            filter: drop-shadow(0 0 20px rgba(249, 115, 22, 0.3));
        }
        #headphones-3d-container {
            width: 100%;
            height: 500px;
            position: relative;
            cursor: grab;
        }

        #headphones-3d-container:active {
            cursor: grabbing;
        }

        .loading-3d {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 1.2rem;
            background: rgba(0, 0, 0, 0.5);
            padding: 1rem 2rem;
            border-radius: 0.5rem;
        }

        
    </style>
</head>
<body class="bg-orange-50">
    @include('partials.navbar')

    <!-- Hero Section -->
    <section class="bg-black text-white relative min-h-screen flex items-center overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-black to-transparent z-10"></div>
        
        <!-- Social Media Links -->
        <div class="fixed right-8 top-1/2 transform -translate-y-1/2 flex flex-col gap-6 z-20">
            <a href="#" class="text-white hover:text-orange-500 transition-colors">
                <i class="fab fa-facebook-f text-xl"></i>
            </a>
            <a href="#" class="text-white hover:text-orange-500 transition-colors">
                <i class="fab fa-instagram text-xl"></i>
            </a>
            <a href="#" class="text-white hover:text-orange-500 transition-colors">
                <i class="fab fa-twitter text-xl"></i>
            </a>
            <a href="#" class="text-white hover:text-orange-500 transition-colors">
                <i class="fab fa-youtube text-xl"></i>
            </a>
        </div>

        <!-- Main Content -->
        <div class="container mx-auto px-6 relative z-20">
            <div class="grid grid-cols-1 md:grid-cols-2 items-center gap-8">
                <div class="max-w-2xl">
                    <h1 class="text-5xl md:text-7xl font-bold mb-6 leading-tight">
                        Welcome to City Center Mall
                    </h1>
                    <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-2xl">
                        Your premier shopping destination with over 200 stores, entertainment, and dining options.
                    </p>
                    <a href="/products" class="inline-flex items-center bg-white text-black px-8 py-4 rounded-full font-semibold hover:bg-orange-500 hover:text-orange-50 transition-all duration-300">
                        Explore Stores
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
                <div class="hidden md:block">
                    <!-- You can add a static image or other content here -->
                </div>
            </div>
        </div>

        <!-- Background Image -->
        <div class="absolute inset-0 z-0">
            <img src="https://images.unsplash.com/photo-1519567241046-7f570eee3ce6?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" 
                 alt="Mall Interior" 
                 class="w-full h-full object-cover opacity-50">
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
                <button class="filter-btn px-4 py-2 rounded-full bg-red-600 text-white" data-category="all">All</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 hover:bg-red-600 hover:text-white transition-colors" data-category="electronics">Electronics</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 hover:bg-red-600 hover:text-white transition-colors" data-category="home">Home</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 hover:bg-red-600 hover:text-white transition-colors" data-category="fitness">Fitness</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 hover:bg-red-600 hover:text-white transition-colors" data-category="kitchen">Kitchen</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 hover:bg-red-600 hover:text-white transition-colors" data-category="garden">Garden</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 hover:bg-red-600 hover:text-white transition-colors" data-category="pets">Pets</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 hover:bg-red-600 hover:text-white transition-colors" data-category="security">Security</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 hover:bg-red-600 hover:text-white transition-colors" data-category="outdoor">Outdoor</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 hover:bg-red-600 hover:text-white transition-colors" data-category="furniture">Furniture</button>
                <button class="filter-btn px-4 py-2 rounded-full bg-gray-200 hover:bg-red-600 hover:text-white transition-colors" data-category="accessories">Accessories</button>
            </div>

            <!-- Loading Spinner -->
            <div class="flex justify-center my-8 hidden" id="loading-spinner">
                <div class="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-red-600"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="products-container">
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
        // Mall-specific products data
        const mallProducts = {
            "City Center Mall": [
                {
                    id: 1,
                    name: "Smart TV 65\"",
                    description: "4K OLED Smart TV with AI processing and gaming features",
                    price: 1299.99,
                    image: "https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                    category: "electronics",
                    features: ["4K OLED", "Gaming Mode", "Smart Hub", "Voice Control"],
                    rating: 4.8,
                    reviews: 245,
                    stock: 15
                },
                {
                    id: 2,
                    name: "Designer Handbag",
                    description: "Luxury leather handbag with gold hardware",
                    price: 899.99,
                    image: "https://images.unsplash.com/photo-1584917865442-de89df76afd3?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                    category: "accessories",
                    features: ["Genuine Leather", "Gold Hardware", "Multiple Compartments"],
                    rating: 4.9,
                    reviews: 189,
                    stock: 8
                }
            ],
            "Waterfront Mall": [
                {
                    id: 1,
                    name: "Yacht Club Membership",
                    description: "Annual membership to exclusive yacht club",
                    price: 5000.00,
                    image: "https://images.unsplash.com/photo-1567899378494-47b22a2ae96a?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                    category: "luxury",
                    features: ["Access to Marina", "Club Events", "Dining Privileges"],
                    rating: 4.9,
                    reviews: 76,
                    stock: 10
                },
                {
                    id: 2,
                    name: "Seafood Restaurant Voucher",
                    description: "Fine dining experience at Ocean View Restaurant",
                    price: 200.00,
                    image: "https://images.unsplash.com/photo-1579027989536-b7b1f875659b?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                    category: "dining",
                    features: ["5-Course Meal", "Wine Pairing", "Ocean View"],
                    rating: 4.8,
                    reviews: 156,
                    stock: 50
                }
            ],
            "Plaza Mall": [
                {
                    id: 1,
                    name: "Gaming Console Pro",
                    description: "Next-gen gaming console with 4K graphics",
                    price: 499.99,
                    image: "https://images.unsplash.com/photo-1605901309584-818e25960a8f?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                    category: "electronics",
                    features: ["4K Gaming", "1TB Storage", "Wireless Controller"],
                    rating: 4.9,
                    reviews: 325,
                    stock: 20
                },
                {
                    id: 2,
                    name: "Smart Home Bundle",
                    description: "Complete smart home automation package",
                    price: 799.99,
                    image: "https://images.unsplash.com/photo-1558002038-1055eec2f0e9?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                    category: "electronics",
                    features: ["Voice Control", "Security System", "Smart Lighting"],
                    rating: 4.7,
                    reviews: 189,
                    stock: 15
                }
            ],
            "Galleria Mall": [
                {
                    id: 1,
                    name: "Designer Watch",
                    description: "Limited edition luxury timepiece",
                    price: 2999.99,
                    image: "https://images.unsplash.com/photo-1523170335258-f5ed11844a49?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                    category: "accessories",
                    features: ["Swiss Movement", "Sapphire Crystal", "Limited Edition"],
                    rating: 4.9,
                    reviews: 87,
                    stock: 5
                },
                {
                    id: 2,
                    name: "Fashion Collection",
                    description: "Exclusive designer clothing collection",
                    price: 1499.99,
                    image: "https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80",
                    category: "fashion",
                    features: ["Limited Edition", "Premium Materials", "Designer Label"],
                    rating: 4.8,
                    reviews: 134,
                    stock: 10
                }
            ]
        };

        // Function to display products based on selected mall
        function displayMallProducts(mallName) {
            const products = mallProducts[mallName] || [];
            const container = document.getElementById('products-container');
            
            // Show loading spinner
            document.getElementById('loading-spinner').classList.remove('hidden');
            
            setTimeout(() => {
                container.innerHTML = '';
                
                products.forEach(product => {
                    const productCard = document.createElement('div');
                    productCard.className = 'product-card bg-white rounded-lg shadow-md overflow-hidden animate__animated animate__fadeIn';
                    productCard.innerHTML = `
                        <img src="${product.image}" alt="${product.name}" class="w-full h-48 object-cover">
                        <div class="p-6">
                            <h3 class="text-xl font-semibold mb-2">${product.name}</h3>
                            <p class="text-gray-600 mb-4">${product.description}</p>
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-2xl font-bold text-red-600">$${product.price.toFixed(2)}</span>
                                <div class="flex items-center">
                                    ${Array(5).fill().map((_, i) => `
                                        <i class="fas fa-star ${i < Math.floor(product.rating) ? 'text-yellow-400' : 'text-gray-300'}"></i>
                                    `).join('')}
                                    <span class="ml-2 text-gray-600">(${product.reviews})</span>
                                </div>
                            </div>
                            <div class="flex flex-wrap gap-2 mb-4">
                                ${product.features.map(feature => `
                                    <span class="px-2 py-1 bg-gray-100 rounded-full text-sm">${feature}</span>
                                `).join('')}
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-gray-500">${product.stock} in stock</span>
                                <div class="flex space-x-2">
                                    <button class="p-2 text-gray-400 hover:text-red-600 transition-colors" onclick="addToWishlist(${JSON.stringify(product).replace(/"/g, '&quot;')})">
                                        <i class="fas fa-heart"></i>
                                    </button>
                                    <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors" onclick="addToCart(${JSON.stringify(product).replace(/"/g, '&quot;')})">
                                        Add to Cart
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    container.appendChild(productCard);
                });
                
                // Hide loading spinner
                document.getElementById('loading-spinner').classList.add('hidden');
            }, 500);
        }

        // Initialize products display when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initial display of products for default mall
            const defaultMall = document.getElementById('selected-mall').textContent;
            displayMallProducts(defaultMall);

            // Handle mall selection
            const mallOptions = document.querySelectorAll('.mall-option');
            mallOptions.forEach(option => {
                option.addEventListener('click', (e) => {
                    e.preventDefault();
                    const mallName = option.getAttribute('data-mall');
                    document.getElementById('selected-mall').textContent = mallName;
                    displayMallProducts(mallName);
                });
            });

            // Handle category filtering
            const filterButtons = document.querySelectorAll('.filter-btn');
            filterButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const category = btn.getAttribute('data-category');
                    const currentMall = document.getElementById('selected-mall').textContent;
                    const products = mallProducts[currentMall] || [];
                    
                    filterButtons.forEach(b => b.classList.remove('bg-red-600', 'text-white'));
                    btn.classList.add('bg-red-600', 'text-white');
                    
                    displayFilteredProducts(products, category);
                });
            });
        });

        // Function to filter products by category
        function displayFilteredProducts(products, category) {
            const filteredProducts = category === 'all' ? products : products.filter(p => p.category === category);
            const container = document.getElementById('products-container');
            
            document.getElementById('loading-spinner').classList.remove('hidden');
            
            setTimeout(() => {
                container.innerHTML = '';
                
                if (filteredProducts.length === 0) {
                    container.innerHTML = `
                        <div class="col-span-full text-center py-8">
                            <p class="text-gray-500 text-lg">No products found in this category</p>
                        </div>
                    `;
                } else {
                    filteredProducts.forEach(product => {
                        const productCard = document.createElement('div');
                        productCard.className = 'product-card bg-white rounded-lg shadow-md overflow-hidden animate__animated animate__fadeIn';
                        productCard.innerHTML = `
                            <img src="${product.image}" alt="${product.name}" class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2">${product.name}</h3>
                                <p class="text-gray-600 mb-4">${product.description}</p>
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-2xl font-bold text-red-600">$${product.price.toFixed(2)}</span>
                                    <div class="flex items-center">
                                        ${Array(5).fill().map((_, i) => `
                                            <i class="fas fa-star ${i < Math.floor(product.rating) ? 'text-yellow-400' : 'text-gray-300'}"></i>
                                        `).join('')}
                                        <span class="ml-2 text-gray-600">(${product.reviews})</span>
                                    </div>
                                </div>
                                <div class="flex flex-wrap gap-2 mb-4">
                                    ${product.features.map(feature => `
                                        <span class="px-2 py-1 bg-gray-100 rounded-full text-sm">${feature}</span>
                                    `).join('')}
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-500">${product.stock} in stock</span>
                                    <div class="flex space-x-2">
                                        <button class="p-2 text-gray-400 hover:text-red-600 transition-colors" onclick="addToWishlist(${JSON.stringify(product).replace(/"/g, '&quot;')})">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                        <button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition-colors" onclick="addToCart(${JSON.stringify(product).replace(/"/g, '&quot;')})">
                                            Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        `;
                        container.appendChild(productCard);
                    });
                }
                
                document.getElementById('loading-spinner').classList.add('hidden');
            }, 500);
        }
    </script>
    
</body>
</html>