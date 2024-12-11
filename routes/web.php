<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDiscountController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::middleware(['auth', 'verified','rolemanager:admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::controller(AdminMainController::class)->group(function () {
            Route::get('/dashboard','index')->name('admin');
            Route::get('/settings','settings')->name('admin.settings');
            Route::get('/manage/user','manage_user')->name('admin.manage.user');
            Route::get('/manage/store','manage_stores')->name('admin.manage.store');
            Route::get('/cart/history','cart_history')->name('admin.cart.history');
            Route::get('/order/history','order_history')->name('admin.order.history');
        });
        Route::controller(CategoryController::class)->group(function () {
            Route::get('/category/create','index')->name('category.create');
            Route::get('/category/manage','manage')->name('category.manage');
        });
        Route::controller(ProductController::class)->group(function () {
            Route::get('/product/manage','index')->name('product.manage');
            Route::get('/product/review/manage','manage')->name('product.manage_review');
        });
        Route::controller(SubCategoryController::class)->group(function () {
            Route::get('/subCategory/create','index')->name('sub_category.create');
            Route::get('/subCategory/manage','manage')->name('sub_category.manage');
        });
        Route::controller(ProductAttributeController::class)->group(function () {
            Route::get('/productattribute/create','index')->name('product_attribute.create');
            Route::get('/productattribute/manage','manage')->name('product_attribute.manage');
        });
        Route::controller(ProductDiscountController::class)->group(function () {
            Route::get('/discount/create','index')->name('discount.create');
            Route::get('/discount/manage','manage')->name('discount.manage');
        });
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified','rolemanager:customer'])->name('dashboard');

Route::get('/vendor/dashboard', function () {
    return view('vendor');
})->middleware(['auth', 'verified','rolemanager:vendor'])->name('vendor');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
