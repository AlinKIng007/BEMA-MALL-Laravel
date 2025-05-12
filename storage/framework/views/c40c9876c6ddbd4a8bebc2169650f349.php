<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
<?php $__env->startSection('content'); ?>
<div class="product-container">
    <div class="product-card">
        <div class="product-image">
            <img src="<?php echo e(asset('images/' . $products->image_1)); ?>"
                 alt="<?php echo e($products->product_name); ?>"
                 class="main-image"
                 data-product-image="<?php echo e(asset('images/' . $products->image_1)); ?>">
        </div>
        <div class="product-details" data-product-id="<?php echo e($products->id); ?>" data-max-quantity="<?php echo e($products->amount); ?>">
            <h1 class="product-title" data-product-name="<?php echo e($products->product_name); ?>">
                <?php echo e($products->product_name); ?>

            </h1>
            <div  class="price-tag" data-product-price="<?php echo e($products->price); ?>">
                $<?php echo e($products->price); ?>

            </div>
            <p class="product-description"><?php echo e($products->description); ?></p>

            <div class="product-meta">
                <div id="div-item-stock" class="meta-item stock">
                    <i class="fas fa-box"></i>
                    <span id="item-stock">In Stock: <?php echo e($products->amount); ?></span>
                </div>

                <div class="meta-item mall">
                    <i class="fas fa-store"></i>
                    <span>Mall: <?php echo e($products->mall_name); ?></span>

                </div>
            </div>

            <input type="text" id="p_id" style="display: none">


            <?php
            $grouped_variations = $variation_values->groupBy('variation_name');
        ?>

        <?php $__currentLoopData = $grouped_variations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variation_name => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($variation_name === 'color'): ?>
                <style>
                    .color-options {
                        margin: 1.5rem 0;
                    }

                    .color-selector {
                        display: flex;
                        gap: 1rem;
                        margin-top: 0.5rem;
                    }

                    .color-btn {
                        width: 40px;
                        height: 40px;
                        border-radius: 50%;
                        border: none;
                        cursor: pointer;
                        transition: transform 0.2s, box-shadow 0.2s;
                    }

                    .color-btn:hover {
                        transform: scale(1.35);
                        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
                    }

                    .color-btn.active {
                        border: 4px solid #fdba74;
                        transform: scale(1.35);
                    }
                </style>

                <div class="color-options">
                    <label><?php echo e(ucfirst($variation_name)); ?>:</label>
                    <div class="color-selector">
                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button class="color-btn" id="vo_id:<?php echo e($value->vo_id); ?>" style="background-color: <?php echo e($value->variation_value); ?>;" data-value="<?php echo e($value->variation_value); ?>">
                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php else: ?>
                <style>
                    .<?php echo e($variation_name); ?>-options {
                        margin: 1.5rem 0;
                    }

                    .<?php echo e($variation_name); ?>-selector {
                        display: flex;
                        gap: 1rem;
                        margin-top: 0.5rem;
                    }

                    .<?php echo e($variation_name); ?>-btn {
                        width: auto;
                        padding: 10px 15px;
                        border-radius: 5px;
                        border: 1px solid #ccc;
                        cursor: pointer;
                        transition: background-color 0.2s;
                    }

                    .<?php echo e($variation_name); ?>-btn:hover {
                        background-color: #f0f0f0;
                    }

                    .<?php echo e($variation_name); ?>-btn.active {
                        background-color: #dcdcdc;
                        border: 2px solid #2d3436;
                    }
                </style>

                <div class="<?php echo e($variation_name); ?>-options">
                    <label><?php echo e(ucfirst($variation_name)); ?>:</label>
                    <div class="<?php echo e($variation_name); ?>-selector">
                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button class="<?php echo e($variation_name); ?>-btn" id="btn-id:<?php echo e($value->vo_id); ?>" data-value="<?php echo e($value->variation_value); ?>">
                                <?php echo e(strtoupper($value->variation_value)); ?>

                            </button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>







            <div class="quantity-control">
                <label>Quantity:</label>
                <div class="quantity-wrapper">
                    <button class="qty-btn minus" onclick="updateQuantity(-1)">
                        <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" id="quantity" value="1" min="1" max="<?php echo e($products->amount); ?>">
                    <button class="qty-btn plus" onclick="updateQuantity(1)">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>

            <div class="action-buttons">
                <button class="btn wishlist-btn" id="wishlist-button" onclick="addToWishlist()">
                    <i class="fas fa-heart"></i>
                    <span>Add to Wishlist</span>
                </button>
                <form id="addToCartForm" action="/cartadd" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="text" id="p_id" value="<?php echo e($products->id); ?>" name="product_id" style="display: none">

                    <input type="text" id="item-stock" value="1" name="amount" style="display: none">
                    <input type="text" id="user_id" value="3" name="user_id" style="display: none">


                <button type="submit" class="btn cart-btn" id="cart-button" onclick="addToCart()">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Add to Cart</span>
                </button>
            </form>
            </div>


        </div>
    </div>
</div>

<div id="notification" class="notification">
    <span id="notificationText"></span>
</div>

<style>
.product-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.product-card {
    display: flex;
    max-width: 1200px;
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    animation: slideIn 0.6s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.product-image {
    flex: 1;
    padding: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8f9fa;
}

.main-image {
    max-width: 100%;
    height: auto;
    object-fit: contain;
    transition: transform 0.3s ease;
}

.main-image:hover {
    transform: scale(1.05);
}

.product-details {
    flex: 1;
    padding: 3rem;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.product-title {
    font-size: 2.5rem;
    color: #2d3436;
    margin: 0;
    line-height: 1.2;
}

.price-tag {
    font-size: 2rem;
    font-weight: bold;
    color: #ff9f39;
    position: relative;
    display: inline-block;
}

.price-tag::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 50px;
    height: 3px;
    background: #ff9f39;
    border-radius: 2px;
}

.product-description {
    color: #636e72;
    line-height: 1.6;
    font-size: 1.1rem;
}

.product-meta {
    display: flex;
    gap: 2rem;
    margin: 1rem 0;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #2d3436;
}

.meta-item i {
    color: #0984e3;
}




.quantity-control {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.quantity-wrapper {
    display: flex;
    align-items: center;
    gap: 1rem;
    background: #f5f6fa;
    padding: 0.5rem;
    border-radius: 10px;
    width: fit-content;
}

.qty-btn {
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 8px;
    background: white;
    color: #2d3436;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.qty-btn:hover {
    background: #0984e3;
    color: white;
    transform: translateY(-2px);
}

.qty-btn:active {
    transform: translateY(0);
}

#quantity {
    width: 60px;
    text-align: center;
    font-size: 1.2rem;
    border: none;
    background: transparent;
    color: #2d3436;
}

.action-buttons {
    display: flex;
    gap: 1rem;
    margin-top: 1rem;
}

.btn {
    flex: 1;
    padding: 1rem;
    border: none;
    border-radius: 10px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.wishlist-btn {
    background: #fff;
    color: #e84393;
    border: 2px solid #e84393;
}

.wishlist-btn:hover {
    background: #e84393;
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(232, 67, 147, 0.3);
}

.cart-btn {
    background: #0984e3;
    color: white;
}

.cart-btn:hover {
    background: #0652DD;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(9, 132, 227, 0.3);
}

.notification {
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 1rem 2rem;
    border-radius: 10px;
    background: #00b894;
    color: white;
    font-size: 1.1rem;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    display: none;
    animation: slideInRight 0.3s ease-out;
}

.notification.error {
    background: #d63031;
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(100px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@media (max-width: 968px) {
    .product-card {
        flex-direction: column;
        margin: 1rem;
    }

    .product-image, .product-details {
        padding: 1.5rem;
    }
}
</style>

<script>
    const productData = {
        id: document.querySelector('[data-product-id]').dataset.productId,
        name: document.querySelector('[data-product-name]').dataset.productName,
        price: document.querySelector('[data-product-price]').dataset.productPrice,
        image: document.querySelector('[data-product-image]').dataset.productImage,
        maxQuantity: parseInt(document.querySelector('[data-max-quantity]').dataset.maxQuantity, 10)
    };

    // Initialize color selection
    document.querySelectorAll('.color-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.color-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    // Initialize size selection
    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            document.querySelectorAll('.size-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
        });
    });

    function updateQuantity(change) {
    const quantityInput = document.getElementById('quantity');
    const maxQuantity = parseInt(quantityInput.getAttribute('max'), 10);  // Get the dynamic max value
    let currentQuantity = parseInt(quantityInput.value, 10) || 1; // Get current quantity (defaults to 1 if invalid)

    let newValue = currentQuantity + change;

    // Ensure the new value is within the valid range (1 to maxQuantity)
    if (newValue < 1) {
        newValue = 1; // Prevent going below 1
    } else if (newValue > maxQuantity) {
        newValue = maxQuantity; // Prevent going above the max available stock
    }

    // Update the input value
    quantityInput.value = newValue;


    document.getElementById("item-stock").value = newValue;


    // Add animation on update
    quantityInput.style.animation = 'none';
    quantityInput.offsetHeight; // Trigger reflow to reset animation
    quantityInput.style.animation = 'pulse 0.3s ease';

    // Optional: If the quantity goes beyond limits, add a shake animation
    if (newValue === 1 || newValue === maxQuantity) {
        quantityInput.style.animation = 'shake 0.3s ease';
    }
}


    function addToWishlist() {
        const button = document.querySelector('.wishlist-btn');
        button.style.pointerEvents = 'none';

        fetch('/wishlist/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                product_id: productData.id
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Product added to wishlist!');
                button.innerHTML = '<i class="fas fa-heart"></i><span>Added to Wishlist</span>';
                button.style.background = '#e84393';
                button.style.color = 'white';
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('An error occurred', 'error');
        })
        .finally(() => {
            button.style.pointerEvents = 'auto';
        });
    }

    function addToCart() {
    const button = document.querySelector('.cart-btn');
    button.style.pointerEvents = 'none';

    const quantity = parseInt(document.getElementById('quantity').value, 10);
    const itemStock = document.getElementById('item-stock').value;
    const productId = document.getElementById('p_id').value;

    // Set form values dynamically (if needed)
    document.getElementById('quantity').value = quantity;
    document.getElementById('item-stock').value = itemStock;
    document.getElementById('p_id').value = productId;

    // Now submit the form
    document.getElementById('addToCartForm').submit();

    // Handle after submission - this will be done server-side (no need for AJAX response here)
    showNotification('Product added to cart!');
    button.innerHTML = '<i class="fas fa-check"></i><span>Added to Cart</span>';
    setTimeout(() => {
        button.innerHTML = '<i class="fas fa-shopping-cart"></i><span>Add to Cart</span>';
    }, 2000);

    // Re-enable the button after the submission
    button.style.pointerEvents = 'auto';
}



    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = `notification ${type}`;
        notification.textContent = message;
        document.body.appendChild(notification);

        // Show notification with animation
        requestAnimationFrame(() => {
            notification.style.display = 'block';
        });

        // Remove notification after delay
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.3s ease-in forwards';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }

    document.getElementById('quantity').addEventListener('input', function (e) {
    const maxQuantity = parseInt(e.target.getAttribute('max'), 10);
    let value = parseInt(e.target.value, 10);

    // Ensure the value is within range
    if (isNaN(value) || value < 1) {
        value = 1;  // Set to 1 if invalid
    } else if (value > maxQuantity) {
        value = maxQuantity;  // Cap the value to max stock
    }

    // Apply the valid value back to the input
    e.target.value = value;
});


    // Add keyframe animations
    const style = document.createElement('style');
    style.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        @keyframes slideOutRight {
            to {
                opacity: 0;
                transform: translateX(100px);
            }
        }
    `;
    document.head.appendChild(style);
</script>









<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initially hide all relevant elements
        const priceTagElement = document.querySelector(".price-tag");
        const quantity = document.getElementById("quantity")
        const stockWrapper = document.getElementById("div-item-stock");
        const stockText = document.getElementById("item-stock");
        const quantityElement = document.querySelector(".quantity-control");
        const wishlistButton = document.getElementById("wishlist-button");
        const cartButton = document.getElementById("cart-button");


        // Initially hide the elements
        priceTagElement.style.display = "none";
        stockWrapper.style.display = "none";
        quantityElement.style.display = "none";
        wishlistButton.style.display = "none";
        cartButton.style.display = "none";

        const selections = {};

        // Get total number of variation groups
        const variationGroups = new Set();
        document.querySelectorAll('[data-value]').forEach(button => {
            const group = button.closest('div').classList[0].replace('-selector', '');
            variationGroups.add(group);
        });

        const totalGroups = variationGroups.size;

        document.querySelectorAll('[data-value]').forEach(button => {
            button.addEventListener('click', function () {
                const group = this.closest('div').classList[0].replace('-selector', '');
                const value = this.getAttribute('data-value');
                const idAttr = this.getAttribute('id');
                const vo_id_match = idAttr && idAttr.match(/[:](\d+)/);
                const vo_id = vo_id_match ? vo_id_match[1] : null;

                selections[group] = {
                    value: value,
                    vo_id: vo_id
                };

                // Highlight selected button
                const groupButtons = document.querySelectorAll(`.${group}-selector [data-value]`);
                groupButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                console.log('Current selections:', selections);

                const selectedVoIds = Object.values(selections)
                    .map(sel => sel.vo_id)
                    .filter(id => id !== null);

                if (selectedVoIds.length === totalGroups) {
                    fetch('/get-product-options', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    },
    body: JSON.stringify({
        vo_ids: selectedVoIds,
        main_product_id: <?php echo e(session("mp_id")); ?>

    })
})
.then(response => response.json())
.then(data => {
    const product = data[0];

    // If no product is returned, hide everything
    if (!product) {
        priceTagElement.style.display = "none";
        stockWrapper.style.display = "none";
        quantityElement.style.display = "none";
        cartButton.style.display = "none";
        wishlistButton.style.display = "none";
        return;
    }

    const amount = product.amount;  // Product stock

    // Show price and stock info
    priceTagElement.style.display = "block";
    priceTagElement.innerText = "$" + product.price;
    stockWrapper.style.display = "block";
    stockText.innerText = `In Stock: ${amount}`;
    stockText.style.color = amount > 0 ? "" : "red";

    // Update the max quantity on the quantity input dynamically
    const quantityInput = document.getElementById('quantity');
    quantityInput.setAttribute('max', amount); // Set max value dynamically

    // Ensure the current quantity is valid (doesn't exceed stock)
    let currentQuantity = parseInt(quantityInput.value, 10);
    if (currentQuantity > amount) {
        quantityInput.value = amount;  // Reset to max if current quantity is too high
    }

    // If out of stock, hide quantity input and action buttons
    if (amount <= 0) {
        quantityElement.style.display = "none";
        wishlistButton.style.display = "none";
        cartButton.style.display = "none";
    } else {
        document.getElementById("p_id").value = product.id;
        quantityElement.style.display = "block";
        wishlistButton.style.display = "block";
        cartButton.style.display = "block";
    }
})
.catch(error => {
    console.error('Error fetching product data:', error);
});

                }
            });
        });
    });
</script>








<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\AA7\Desktop\programming\Laravel\mall---v4\mall\resources\views/product.blade.php ENDPATH**/ ?>