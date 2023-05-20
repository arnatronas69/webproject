<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

Route::view('/', 'pages.home');
Route::view('/home', 'pages.home');
Route::view('/about', 'pages.about');
Route::view('/contacts', 'pages.contacts')->name('contacts');
Route::view('/admin', 'admin.dashboard');
Route::view('/checkout', 'pages.checkout');

Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view'); // Display cart
Route::get('/cart/count', [CartController::class, 'getCartCount']); // Get cart count
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add'); // Add to cart
Route::delete('/cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove'); // Remove from cart
Route::patch('/cart/{id}/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');

// Checkout route
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
Route::post('/checkout/process', [CheckoutController::class, 'processCheckout'])->name('checkout.process');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Livewire profile route
    Route::get('/profile', [ProfileController::class, 'show'])
    ->name('profile')
    ->middleware('web');

});

// Login route
Route::view('/login', 'auth.login')
    ->name('login')
    ->middleware('guest');


Route::get('/shop', [ShopController::class, 'index']);
Route::get('/{id}', [DetailController::class, 'show'])->name('product.show');
Route::get('/home', [HomeController::class, 'index']);