<?php
use App\Http\Controllers\Cart_WishlistController;
use App\Http\Controllers\NavController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Mall;



// Auth Routes (Accessible without being logged in)
Route::middleware('guest')->group(function () {
    Route::get('/signup', [App\Http\Controllers\Auth\SignupController::class, 'showSignupForm'])->name('signup');
    Route::post('/signup', [App\Http\Controllers\Auth\SignupController::class, 'signup']);
    Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
});

// Protected Routes (Require login)
Route::middleware('auth')->group(function () {


    // Public Route
Route::get('/', function () {
    return view('welcome');
});


    // Wishlist
    Route::get('/wishlist', function () {
        return view('wishlist');
    });

    // Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

    // Set Mall (Session handling)
    Route::post('/set-mall', function (Request $request) {
        $mallId = $request->input('mall_id');

        if ($mallId != 0) {
            $request->validate([
                'mall_id' => 'required|exists:malls,id',
            ]);

            $mall = Mall::find($mallId);
            session([
                'mall_id' => $mall->id,
                'mall_name' => $mall->mall_name,
            ]);
        } else {
            // Handle 'All Malls' case
            session([
                'mall_id' => 0,
                'mall_name' => 'All Malls',
            ]);
        }

        return redirect()->back();
    })->name('set.mall');

    // Get Product Options
    Route::post('/get-product-options', [ProductController::class, 'getProductOptions']);

    // Cart Routes
    Route::post('/cartadd', [ProductController::class, 'cartAdd']);
    Route::get('/cart', [Cart_WishlistController::class, 'indexCart']);
    Route::post('/cart/delete', [Cart_WishlistController::class, 'deleteCart']);

    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orderadd', [OrderController::class, 'create']);
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');

    // Logout (Available for logged-in users)
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});
