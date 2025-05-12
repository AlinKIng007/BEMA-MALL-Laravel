<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-lg overflow-hidden transition-all duration-300 hover:shadow-xl">
        <div class="p-6 border-b border-gray-200" style="background: linear-gradient(to right, #f97316, #ea580c);">
            <h2 class="text-3xl font-bold text-white mb-4">Orders</h2>
        </div>
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead style="background-color: #fff7ed;">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #ea580c;">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #ea580c;">Product</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #ea580c;">Price</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #ea580c;">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #ea580c;">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #ea580c;">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #ea580c;">Payment Method</th>
                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider" style="color: #ea580c;">Purchase Date</th>
                            
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="transition-colors duration-200 ease-in-out order-row">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#<?php echo e($order->id); ?></td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($order->product_name ? $order->product_name : 'N/A'); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($order->amount); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold" style="color: #ea580c;">$<?php echo e(number_format($order->price, 2)); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold" style="color: #ea580c;">$<?php echo e($order->price * $order->amount); ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">




                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full"
                                style="padding:10px;
                                <?php if($order->level == 1): ?> background-color: #dbeafe; color: #1e40af;
                                        <?php elseif($order->level == 2): ?> background-color: #dcfce7; color: #15803d;
                                        <?php elseif($order->level == 3): ?> background-color: #fee2e2; color: #b91c1c;
                                        <?php else: ?> background-color: #f3f4f6; color: #374151; <?php endif; ?>">

                            </span>



                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full">
                                    <?php echo e($order->type ? $order->type : 'Unknown'); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?php echo e($order->method_name ? $order->method_name : 'N/A'); ?></td>
<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
    <?php echo e($order->time_of_purchase ?? 'N/A'); ?>

</td>


                            
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>


        </div>
    </div>
</div>

<style>
    /* Fade in animation for table rows */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    tbody tr {
        animation: fadeIn 0.3s ease-in-out forwards;
    }

    tbody tr:nth-child(1) { animation-delay: 0.1s; }
    tbody tr:nth-child(2) { animation-delay: 0.2s; }
    tbody tr:nth-child(3) { animation-delay: 0.3s; }
    tbody tr:nth-child(4) { animation-delay: 0.4s; }
    tbody tr:nth-child(5) { animation-delay: 0.5s; }
    tbody tr:nth-child(6) { animation-delay: 0.6s; }
    tbody tr:nth-child(7) { animation-delay: 0.7s; }
    tbody tr:nth-child(8) { animation-delay: 0.8s; }
    tbody tr:nth-child(9) { animation-delay: 0.9s; }
    tbody tr:nth-child(10) { animation-delay: 1s; }

    .order-row:hover {
        background-color: #fff7ed !important;
    }

    .order-button:hover {
        background-color: #c2410c !important;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\AA7\Desktop\programming\Laravel\mall---v6\mall\resources\views/orders/index.blade.php ENDPATH**/ ?>