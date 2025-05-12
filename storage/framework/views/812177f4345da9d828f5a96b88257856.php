

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl animate-fade-in-up">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center" style="background: linear-gradient(to right, #f97316, #ea580c);">
            <h2 class="text-3xl font-bold text-white">Order Details #<?php echo e($order->id); ?></h2>
            <a href="<?php echo e(route('orders.index')); ?>" 
               class="inline-flex items-center px-4 py-2 border border-white rounded-md shadow-sm text-sm font-medium text-white transition-all duration-200"
               style="hover:background-color: white; hover:color: #ea580c;">
                <svg class="h-4 w-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Orders
            </a>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Order Information -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden animate-fade-in-left">
                    <div class="px-6 py-4 border-b border-gray-200" style="background-color: #fff7ed;">
                        <h4 class="text-lg font-semibold" style="color: #ea580c;">Order Information</h4>
                    </div>
                    <div class="p-6">
                        <dl class="space-y-4">
                            <div class="flex justify-between">
                                <dt class="text-sm font-medium text-gray-500">Order ID:</dt>
                                <dd class="text-sm text-gray-900">#<?php echo e($order->id); ?></dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm font-medium text-gray-500">Purchase Date:</dt>
                                <dd class="text-sm text-gray-900"><?php echo e($order->time_of_purchase ? $order->time_of_purchase->format('M d, Y H:i') : 'N/A'); ?></dd>
                            </div>
                            <div class="flex justify-between items-center">
                                <dt class="text-sm font-medium text-gray-500">Status:</dt>
                                <dd class="text-sm">
                                    <?php
                                        $statusColor = $order->status 
                                            ? ($order->status->name === 'Completed' 
                                                ? 'background-color: #dcfce7; color: #15803d;' 
                                                : ($order->status->name === 'Pending' 
                                                    ? 'background-color: #ffedd5; color: #c2410c;' 
                                                    : 'background-color: #f3f4f6; color: #374151;'))
                                            : 'background-color: #f3f4f6; color: #374151;';
                                    ?>
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full" style="<?php echo e($statusColor); ?>">
                                        <?php echo e($order->status ? $order->status->name : 'Unknown'); ?>

                                    </span>
                                </dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm font-medium text-gray-500">Amount:</dt>
                                <dd class="text-sm font-semibold" style="color: #ea580c;">$<?php echo e(number_format($order->amount, 2)); ?></dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="bg-white rounded-lg border border-gray-200 overflow-hidden animate-fade-in-right">
                    <div class="px-6 py-4 border-b border-gray-200" style="background-color: #fff7ed;">
                        <h4 class="text-lg font-semibold" style="color: #ea580c;">Customer Information</h4>
                    </div>
                    <div class="p-6">
                        <dl class="space-y-4">
                            <div class="flex justify-between">
                                <dt class="text-sm font-medium text-gray-500">Customer Name:</dt>
                                <dd class="text-sm text-gray-900"><?php echo e($order->user ? $order->user->name : 'N/A'); ?></dd>
                            </div>
                            <div class="flex justify-between">
                                <dt class="text-sm font-medium text-gray-500">Email:</dt>
                                <dd class="text-sm text-gray-900"><?php echo e($order->user ? $order->user->email : 'N/A'); ?></dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="mt-6 bg-white rounded-lg border border-gray-200 overflow-hidden animate-fade-in-up">
                <div class="px-6 py-4 border-b border-gray-200" style="background-color: #fff7ed;">
                    <h4 class="text-lg font-semibold" style="color: #ea580c;">Product Details</h4>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead style="background-color: #fff7ed;">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #ea580c;">Product Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #ea580c;">Price</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #ea580c;">Payment Method</th>
                                    <?php if($order->coupon): ?>
                                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #ea580c;">Applied Coupon</th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr class="transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($order->product ? $order->product->name : 'N/A'); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold" style="color: #ea580c;">$<?php echo e($order->product ? number_format($order->product->price, 2) : '0.00'); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($order->payment_method ? $order->payment_method->name : 'N/A'); ?></td>
                                    <?php if($order->coupon): ?>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                                  style="background-color: #ffedd5; color: #c2410c;">
                                                <?php echo e($order->coupon->code); ?> (<?php echo e($order->coupon->discount); ?>% off)
                                            </span>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInLeft {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
    }

    .animate-fade-in-left {
        animation: fadeInLeft 0.5s ease-out forwards;
        animation-delay: 0.2s;
        opacity: 0;
    }

    .animate-fade-in-right {
        animation: fadeInRight 0.5s ease-out forwards;
        animation-delay: 0.2s;
        opacity: 0;
    }

    tr:hover {
        background-color: #fff7ed !important;
    }

    a:hover {
        background-color: white !important;
        color: #ea580c !important;
    }
</style>
<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\bahaa\OneDrive\Desktop\laravel\mall\resources\views/orders/show.blade.php ENDPATH**/ ?>