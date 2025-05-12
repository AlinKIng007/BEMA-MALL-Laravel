<?php
    $mall_name = session('mall_name') ?? 0;
?>

<header class="bg-white shadow-md fixed w-full z-50">
    <nav class="container mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="relative group">
                    <button id="mall-selector" type="button" class="flex items-center space-x-2 text-2xl font-bold gradient-text">
                        <span id="selected-mall">
                            <?php if($mall_name === 0): ?>
                                All Malls
                            <?php else: ?>
                                <?php echo e($mall_name); ?>

                            <?php endif; ?>
                        </span>

                        <i class="fas fa-chevron-down text-sm transition-transform duration-200"></i>
                    </button>

                    <!-- Fixed: Add missing mall-dropdown ID -->
                    <div id="mall-dropdown" class="hidden absolute left-0 mt-2 w-64 bg-white rounded-lg shadow-xl py-2 z-50">
                        <?php $__currentLoopData = $malls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mall): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <form method="POST" action="<?php echo e(route('set.mall')); ?>">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="mall_id" value="<?php echo e($mall->id); ?>">
                                <button type="submit" class="w-full text-left flex items-center px-4 py-3 hover:bg-orange-50 transition-colors">
                                    <div>
                                        <div class="font-semibold"><?php echo e($mall->mall_name); ?></div>
                                        <div class="text-sm text-gray-500"><?php echo e($mall->mall_address ?? 'Location not specified'); ?></div>
                                    </div>
                                </button>
                            </form>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <form method="POST" action="<?php echo e(route('set.mall')); ?>">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="mall_id" value="0">
                            <button type="submit" class="w-full text-left flex items-center px-4 py-3 hover:bg-orange-50 transition-colors">
                                <div>
                                    <div class="font-semibold">All Malls</div>
                                    <div class="text-sm text-gray-500">All locations combined</div>
                                </div>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-6">
                <a href="/" class="text-gray-600 nav-link">Home</a>
                <a href="/products" class="text-gray-600 nav-link">Products</a>
                <a href="<?php echo e(route('orders.index')); ?>" class="text-gray-600 nav-link">Orders</a>

                <div class="flex items-center space-x-4">
                    <a href="/wishlist" class="relative group">
                        <i class="fas fa-heart text-2xl text-gray-600 group-hover:text-red-600 transition-colors"></i>
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs" id="wishlist-count">0</span>
                    </a>
                    <a href="/cart" class="relative group">
                        <i class="fas fa-shopping-cart text-2xl text-gray-600 group-hover:text-orange-600 transition-colors"></i>
                        <span class="absolute -top-2 -right-2 bg-orange-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs" id="cart-count">0</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- JavaScript Dropdown Functionality -->
    <script>
        const mallSelector = document.getElementById('mall-selector');
        const mallDropdown = document.getElementById('mall-dropdown');

        mallSelector.addEventListener('click', () => {
            mallDropdown.classList.toggle('hidden');
            mallSelector.querySelector('i').classList.toggle('rotate-180');
        });

        document.addEventListener('click', (e) => {
            if (!mallSelector.contains(e.target)) {
                mallDropdown.classList.add('hidden');
                mallSelector.querySelector('i').classList.remove('rotate-180');
            }
        });
    </script>
</header>
<?php /**PATH C:\Users\AA7\Desktop\mall---v6\mall\resources\views/partials/navbar.blade.php ENDPATH**/ ?>