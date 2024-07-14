<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\coupon\CouponController;
use App\Http\Controllers\CouponVarationController;
use App\Http\Controllers\StoresController;
use App\Http\Controllers\User\UserCoupon;
use App\Http\Controllers\Frontend\FrontendController;
use App\Models\Brands;
use Illuminate\Http\Request;
use App\Product;

require __DIR__ . '/auth.php';

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/profiles', [ProfileController::class, 'profiles_view'])->name('profiles');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// admin routes

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminLoginController::class, 'index'])->name('admin.admin');

    // coupon controller
    Route::get("/coupon/create", [CouponController::class, 'create'])->name('admin.coupon.create');
    Route::post('/coupon/store', [CouponController::class, 'store'])->name('admin.coupon.store');
    Route::get("/coupon/view", [CouponController::class, 'index'])->name('admin.coupon.view');
    Route::get("/edit/{id}", [CouponController::class, 'edit'])->name('admin.coupon.edit');
    Route::put("/coupon/update/{id}", [CouponController::class, 'update'])->name('admin.coupon.update');
    Route::delete("/coupon/delete/{id}", [CouponController::class, 'destroy'])->name('admin.coupon.delete');

    //Daily Admin couponCode Generate Routes
    Route::get('/createDailyCouponCode', [CouponController::class, 'dailyCreateView'])->name('admin.coupon.dailyCreateForm');
    Route::post('/storeDailyCouponCode', [CouponController::class, 'dailyCouponCodeStore'])->name('admin.coupon.DailyCouponStore');

    //Daily Admin Select Winners routes
    Route::get('/createDailyWinner', [CouponController::class, 'dailyWinnerView'])->name('admin.coupon.dailyWinner');
    Route::post('/storeDailyWinner', [CouponController::class, 'dailyWinnerStore'])->name('admin.coupon.dailyWinnerStore');


    // brands
    Route::get("/brands", [BrandController::class, 'create'])->name('admin.brands');
    Route::post("/brands", [BrandController::class, 'store'])->name('admin.brands');
    Route::get("/brands-list", [BrandController::class, 'index'])->name('admin.brands-list');
    Route::get("/edit-brands-list/{id}", [BrandController::class, 'edit'])->name('admin.edit-brands-list');
    Route::put("/update-brand/{id}", [BrandController::class, 'update'])->name('admin.update-brand');
    Route::delete("/delete-brand/{id}", [BrandController::class, 'destroy'])->name('admin.delete-brand');



    //category
    Route::get("/category", [CategoryController::class, 'create'])->name('admin.category');
    Route::post('/category', [CategoryController::class, 'store'])->name('admin.category');
    Route::get("/category-list", [CategoryController::class, 'index'])->name('admin.category-list');
    Route::get("/edit-category/{id}", [CategoryController::class, 'edit'])->name('admin.edit-category');
    Route::post("/update-category/{id}", [CategoryController::class, 'update'])->name('admin.update-category');
    Route::delete("/delete-category/{id}", [CategoryController::class, 'destroy'])->name('admin.delete-category');



    //stores
    Route::get("/stores", [StoresController::class, 'create'])->name('admin.stores');
    Route::post('/stores', [StoresController::class, 'store'])->name('admin.stores');
    Route::get("/stores-list", [StoresController::class, 'index'])->name('admin.stores-list');
    Route::get("/edit-stores-list/{id}", [StoresController::class, 'edit'])->name('admin.edit-stores-list');
    Route::post("/update-store/{id}", [StoresController::class, 'update'])->name('admin.update-store');
    Route::delete("/delete-store/{id}", [StoresController::class, 'destroy'])->name('admin.delete-store');


    // coupon varition
    Route::get("/couponvaration/{id}", [CouponVarationController::class, 'index'])->name('admin.couponvaration');
    // Create import route
    Route::post('/couponvaration/{id}', [CouponVarationController::class, 'import'])->name('admin.import');
    // Create export route
    Route::get('/export/{id}', [CouponVarationController::class, 'export'])->name('admin.export');
});


// frontends url
Route::get('/', [FrontendController::class, 'index'])->name("home");
Route::get('/allcoupon', [UserCoupon::class, 'allcoupon'])->name('allcoupon');
Route::get('/allcoupondetail/{id}', [UserCoupon::class, 'allcoupondetail'])->name('allcoupondetail');

Route::get('/numbersGame/{id}', [UserCoupon::class, 'game1to100'])->name('numbersCouponCode');
Route::get('/alphabetsGame/{id}', [UserCoupon::class, 'gameatoz'])->name('alphabetCouponCode');

// save game data
Route::post('/numbergame', [UserCoupon::class, 'game1to100Save'])->name('numbergame');
Route::post('/alphabetGame', [UserCoupon::class, 'gameAtoZSave'])->name('alphabetGame');

Route::get('/razorpay_success/{payid}/{order_id}', [UserCoupon::class, 'paymentSuccess'])->name('razorpaySuccess');