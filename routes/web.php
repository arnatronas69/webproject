<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminManufacturerController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\AdminTagController;

Route::view('/', 'pages.home');
Route::view('/home', 'pages.home');
Route::view('/about', 'pages.about');
Route::view('/contacts', 'pages.contacts')->name('contacts');
Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
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

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', AdminProductController::class);
    Route::get('products/create', [AdminProductController::class, 'create'])->name('admin.products.create');
    Route::get('products/{product}', [AdminProductController::class, 'show'])->name('admin.products.show');
    Route::get('products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');
    Route::delete('products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::put('products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');
    Route::resource('manufacturers', AdminManufacturerController::class);
    Route::get('manufacturers/create', [AdminManufacturerController::class, 'create'])->name('admin.manufacturers.create');
    Route::get('manufacturers/{manufacturer}', [AdminManufacturerController::class, 'show'])->name('admin.manufacturers.show');
    Route::get('manufacturers/{manufacturer}/edit', [AdminManufacturerController::class, 'edit'])->name('admin.manufacturers.edit');
    Route::delete('manufacturers/{manufacturer}', [AdminManufacturerController::class, 'destroy'])->name('admin.manufacturers.destroy');
    Route::put('manufacturers/{manufacturer}', [AdminManufacturerController::class, 'update'])->name('admin.manufacturers.update');
    Route::post('/manufacturers', [AdminManufacturerController::class, 'store'])->name('admin.manufacturers.store');
    Route::resource('categories', AdminCategoryController::class);
    Route::get('categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');
    Route::get('categories/{category}', [AdminCategoryController::class, 'show'])->name('admin.categories.show');
    Route::get('categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::delete('categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::put('categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');
    Route::resource('tags', AdminTagController::class);
    Route::get('tags/create', [AdminTagController::class, 'create'])->name('admin.tags.create');
    Route::get('tags/{tag}', [AdminTagController::class, 'show'])->name('admin.tags.show');
    Route::get('tags/{tag}/edit', [AdminTagController::class, 'edit'])->name('admin.tags.edit');
    Route::delete('tags/{tag}', [AdminTagController::class, 'destroy'])->name('admin.tags.destroy');
    Route::put('tags/{tag}', [AdminTagController::class, 'update'])->name('admin.tags.update');
    Route::post('/tags', [AdminTagController::class, 'store'])->name('admin.tags.store');
});