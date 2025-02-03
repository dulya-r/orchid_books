<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>Shop - Orchid Books</title>

    <!-- Fonts & Tailwind CSS -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="bg-purple-100 text-gray-900">

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
                            <?php else: ?>
                            <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="text-white hover:text-gray-300">Log Out</button>
                            </form>
                            <?php endif; ?>
                        </ul>
                    </div>
            
                    <!-- Mobile Links  -->
                    <div id="mobile-nav" class="lg:hidden hidden">
                        <ul class="space-y-4 px-4 py-3">
                            <li><a href="<?php echo e(route('home')); ?>" class="text-white hover:underline">Home</a></li>
                            <li><a href="<?php echo e(route('shop')); ?>" class="text-white hover:underline">Shop</a></li>
                            <li><a href="<?php echo e(route('services')); ?>" class="text-white hover:underline">Our Services</a></li>
                            <?php if(auth()->guard()->guest()): ?>
                                <li><a href="<?php echo e(route('login')); ?>" class="text-white hover:underline">Login</a></li>
                                <li><a href="<?php echo e(route('register')); ?>" class="text-white hover:underline">Register</a></li>
                            <?php else: ?>
                                <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="text-white hover:text-gray-300">Log Out</button>
                                </form>
                             <?php endif; ?>
                        </ul>
                    </div>
                </nav>

    <!-- Welcome Section (Cover Image) -->
    <section class="relative flex flex-col items-center justify-center text-center min-h-screen bg-purple-600">
        <img src="<?php echo e(asset('images/shop-bg.jpg')); ?>" alt="Services Background Image" class="w-full h-full object-cover absolute inset-0">
    </section>

<!-- Welcome Text Section -->
<section class="bg-purple-100 py-12 text-center mt-8">
  <h1 class="text-4xl font-bold text-purple-600">Shop</h1>
  <p class="text-gray-700 leading-relaxed max-w-3xl mx-auto px-4">
    At Orchid Books, we offer a carefully curated selection of books to satisfy every reader's taste. Whether you're a fan of gripping fiction or insightful non-fiction, our shop ensures you have access to quality titles that cater to your literary preferences. Explore our collection and discover your next great read!
  </p>
</section>

<!-- Fiction Section -->
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-purple-600 mb-6">Fiction Books</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $fictionBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-purple-100 p-6 rounded-lg shadow-lg"> <!-- Light Purple Background -->
                    <!-- Image Adjusted to fit -->
                    <img src="<?php echo e(asset('storage/' . $book->image)); ?>" alt="<?php echo e($book->title); ?>" class="w-full h-48 object-contain rounded-lg mb-4">
                    <h3 class="text-xl font-semibold text-purple-600 mb-2"><?php echo e($book->title); ?></h3>
                    <p class="text-gray-700 mb-4"><?php echo e($book->author); ?></p>
                    <p class="text-lg font-semibold text-purple-600">$<?php echo e($book->price); ?></p>
                    
                    <!-- View Details Button -->
                    
                    
                    <!-- Add to Cart Button -->
                    <form action="<?php echo e(route('cart.add', $book->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            Add to Cart
                        </button>
                    </form>
                    
                </div>

                <!-- Modal for Book Details-->
                <div class="modal fade" id="bookDetailsModal<?php echo e($book->id); ?>" tabindex="-1" aria-labelledby="bookDetailsModalLabel<?php echo e($book->id); ?>" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="bookDetailsModalLabel<?php echo e($book->id); ?>"><?php echo e($book->title); ?> - Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><?php echo e($book->description); ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<!-- Non-Fiction Section -->
<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-purple-600 mb-6">Non-Fiction Books</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php $__currentLoopData = $nonFictionBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-purple-100 p-6 rounded-lg shadow-lg">
                    <!-- Image Adjusted to fit -->
                    <img src="<?php echo e(asset('storage/' . $book->image)); ?>" alt="<?php echo e($book->title); ?>" class="w-full h-48 object-contain rounded-lg mb-4">
                    <h3 class="text-xl font-semibold text-purple-600 mb-2"><?php echo e($book->title); ?></h3>
                    <p class="text-gray-700 mb-4"><?php echo e($book->author); ?></p>
                    <p class="text-lg font-semibold text-purple-600">$<?php echo e($book->price); ?></p>
                    
                    <!-- View Details Button -->
                    
                    
                    <!-- Add to Cart Button -->
                    <form action="<?php echo e(route('cart.add', $book->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            Add to Cart
                        </button>
                    </form>
                    
                </div>

                <!-- Modal for Book Details-->
                <div class="modal fade" id="bookDetailsModal<?php echo e($book->id); ?>" tabindex="-1" aria-labelledby="bookDetailsModalLabel<?php echo e($book->id); ?>" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="bookDetailsModalLabel<?php echo e($book->id); ?>"><?php echo e($book->title); ?> - Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p><?php echo e($book->description); ?></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


    <!-- Footer -->
    <footer class="bg-purple-600 text-white py-8">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; <?php echo e(now()->year); ?> Orchid Books. All rights reserved.</p>
        </div>
    </footer>

    <script>
        const hamburgerBtn = document.getElementById('hamburger-btn');
        const mobileNav = document.getElementById('mobile-nav');

        hamburgerBtn.addEventListener('click', () => {
            mobileNav.classList.toggle('hidden');
        });
    </script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\book_store\resources\views/shop.blade.php ENDPATH**/ ?>