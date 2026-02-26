<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\ClothesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ClothesController as AdminClothesController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\User\ProductController as UserProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- AUTHENTICATED AREA ---
Route::middleware('auth')->group(function () {
    // Moved from public access to require login - Landing at root now forces login
    Route::get('/', [UserHomeController::class, 'index'])->name('user.home');
    Route::get('/about', function () { return view('about'); })->name('about');
    Route::get('/contact', function () { return view('contact'); })->name('contact');

    // Clothes Routes (Now Protected)
    Route::get('/clothes/suggestions', [ClothesController::class, 'searchSuggestions'])->name('clothes.suggestions');
    Route::get('/clothes', [ClothesController::class, 'index'])->name('clothes.index');
    Route::get('/clothes/{clothes}', [ClothesController::class, 'show'])->name('clothes.show');
    Route::get('/produk', [UserProductController::class, 'index'])->name('user.product.index');

    // Cart & Order Routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    Route::get('/payments/{orderId}', [PaymentController::class, 'show'])->name('payments.show');
    Route::post('/payments/{paymentId}/confirm', [PaymentController::class, 'confirm'])->name('payments.confirm');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // --- ADMIN AREA (Nested inside auth for simplicity, still requires 'admin' role) ---
    Route::prefix('admin')->middleware(['admin'])->group(function() {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Products
        Route::resource('product', AdminProductController::class)->names('admin.product');

        // Clothes (Admin CRUD)
        Route::resource('clothes', AdminClothesController::class)->names([
            'index' => 'admin.clothes.index',
            'create' => 'admin.clothes.create',
            'store' => 'admin.clothes.store',
            'edit' => 'admin.clothes.edit',
            'update' => 'admin.clothes.update',
            'destroy' => 'admin.clothes.destroy',
        ]);

        Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');
        Route::match(['get', 'post'], '/orders/{id}/complete', [AdminOrderController::class, 'complete'])->name('admin.orders.complete');
        Route::get('/payments', [AdminPaymentController::class, 'index'])->name('admin.payments.index');
        Route::post('/payments/{id}/confirm', [AdminPaymentController::class, 'confirm'])->name('admin.payments.confirm');

        // Other Admin Resources
        Route::resource('publishers', \App\Http\Controllers\Admin\PublisherController::class)->names('admin.publishers');
        Route::resource('shelves', \App\Http\Controllers\Admin\ShelfController::class)->names('admin.shelves');
        Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->names('admin.categories');
        Route::resource('books', \App\Http\Controllers\Admin\BookController::class)->names('admin.books');
    });
});

require __DIR__.'/auth.php';
