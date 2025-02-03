

<?php $__env->startSection('content'); ?>

    <!-- Navigation Bar -->
    <nav class="bg-purple-600 p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <a href="<?php echo e(route('home')); ?>" class="text-white text-xl font-bold">Orchid Books</a>

            <!-- Mobile Hamburger Button -->
            <div class="lg:hidden">
                <button id="hamburger-btn" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Desktop Links -->
            <ul class="hidden lg:flex space-x-6">
                <li><a href="<?php echo e(route('home')); ?>" class="text-white hover:underline">Home</a></li>
                <li><a href="<?php echo e(route('shop')); ?>" class="text-white hover:underline">Shop</a></li>
                <li><a href="<?php echo e(route('services')); ?>" class="text-white hover:underline">Our Services</a></li>
                <?php if(auth()->guard()->guest()): ?>
                    <li><a href="<?php echo e(route('login')); ?>" class="text-white hover:underline">Login</a></li>
                    <li><a href="<?php echo e(route('register')); ?>" class="text-white hover:underline">Register</a></li>
                <?php endif; ?>
            </ul>

            <!-- Mobile Links -->
            <ul id="mobile-nav" class="lg:hidden hidden absolute bg-purple-600 top-16 left-0 w-full py-4 space-y-4 text-center">
                <li><a href="<?php echo e(route('home')); ?>" class="text-white">Home</a></li>
                <li><a href="<?php echo e(route('shop')); ?>" class="text-white">Shop</a></li>
                <li><a href="<?php echo e(route('services')); ?>" class="text-white">Our Services</a></li>
                <?php if(auth()->guard()->guest()): ?>
                    <li><a href="<?php echo e(route('login')); ?>" class="text-white">Login</a></li>
                    <li><a href="<?php echo e(route('register')); ?>" class="text-white">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Checkout Page Content -->
    <div class="container mx-auto px-4 py-6 bg-purple-50">
        <h1 class="text-3xl font-semibold mb-6 text-purple-600 text-center">Checkout</h1>

        <!-- Cart Summary -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
            <h2 class="text-2xl font-semibold text-purple-600 p-4">Order Summary</h2>
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-purple-600 text-white">
                        <th class="py-2 px-4 text-center">Product</th>
                        <th class="py-2 px-4 text-center">Quantity</th>
                        <th class="py-2 px-4 text-center">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cartItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="border-b hover:bg-purple-50">
                            <td class="py-2 px-4 text-center"><?php echo e($cartItem->book->title); ?></td>
                            <td class="py-2 px-4 text-center"><?php echo e($cartItem->quantity); ?></td>
                            <td class="py-2 px-4 text-center"><?php echo e($cartItem->subtotal); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>

            <div class="p-4">
                <strong class="text-xl">Total: </strong><span class="text-lg font-semibold"><?php echo e($cartItems->sum('subtotal')); ?></span>
            </div>
        </div>

        <!-- Checkout Form -->
        <div class="bg-white shadow-lg rounded-lg overflow-hidden p-6">
            <form action="<?php echo e(route('order.place')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-black-600">Name</label>
                        <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label for="email" class="block text-black-600">Email</label>
                        <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="phone" class="block text-black-600">Phone</label>
                        <input type="text" name="phone" id="phone" value="<?php echo e(old('phone')); ?>" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label for="address" class="block text-black-600">Address</label>
                        <input type="text" name="address" id="address" value="<?php echo e(old('address')); ?>" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="country" class="block text-black-600">Country</label>
                        <input type="text" name="country" id="country" value="<?php echo e(old('country')); ?>" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        <?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label for="city" class="block text-black-600">City</label>
                        <input type="text" name="city" id="city" value="<?php echo e(old('city')); ?>" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label for="payment_method" class="block text-black-600">Payment Method</label>
                        <input type="text" name="payment_method" id="payment_method" value="<?php echo e(old('payment_method')); ?>" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        <?php $__errorArgs = ['payment_method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div>
                        <label for="pincode" class="block text-black-600">Pincode</label>
                        <input type="text" name="pincode" id="pincode" value="<?php echo e(old('pincode')); ?>" class="w-full p-2 border border-gray-300 rounded mt-2" required>
                        <?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-sm"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <button type="submit" class="bg-purple-600 text-white py-2 px-6 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                        Place Order
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Success Modal -->
    <?php if(session('orderPlaced')): ?>
    <div id="successModal" class="fixed inset-0 flex justify-center items-center bg-gray-900 bg-opacity-50">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold text-purple-600">Thank You! Your Order has been placed.</h2>
            <div class="mt-4 text-center">
                <button id="closeModal" class="bg-purple-600 text-white py-2 px-6 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                    OK
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <script>
        document.getElementById('closeModal').addEventListener('click', function() {
            window.location.reload();
        });

        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileNav = document.getElementById('mobile-nav');

        hamburgerBtn.addEventListener('click', () => {
            mobileNav.classList.toggle('hidden');
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\book_store\resources\views/checkout.blade.php ENDPATH**/ ?>