<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountCodeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // روتات للفئات
    Route::prefix('categories')->group(function () {
        // عرض كل الفئات
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index');

        // صفحة إنشاء فئة جديدة
        Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');

        // حفظ فئة جديدة
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store');

        // صفحة تعديل فئة
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

        // تحديث فئة
        Route::post('/{category}', [CategoryController::class, 'update'])->name('categories.update');

        // حذف فئة
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    // روتات للمنتجات
    Route::prefix('products')->group(function () {
        // عرض جميع المنتجات
        Route::get('/', [ProductController::class, 'index'])->name('products.index');

        // صفحة إنشاء منتج
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');

        // حفظ منتج جديد
        Route::post('', [ProductController::class, 'store'])->name('products.store');

        // صفحة تعديل منتج
        Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

        // تحديث المنتج
        Route::post('/{product}', [ProductController::class, 'update'])->name('products.update');

        // حذف المنتج
        Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    });

    // روتات للكودي الخصم
    Route::prefix('discount-codes')->group(function () {
        // عرض جميع كودي الخصم
        Route::get('/', [DiscountCodeController::class, 'index'])->name('discount-codes.index');

        // صفحة إنشاء كود خصم جديد
        Route::get('/create', [DiscountCodeController::class, 'create'])->name('discount-codes.create');

        // حفظ كود خصم جديد
        Route::post('/', [DiscountCodeController::class, 'store'])->name('discount-codes.store');

        // صفحة تعديل كود خصم
        Route::get('/{discount_code}/edit', [DiscountCodeController::class, 'edit'])->name('discount-codes.edit');

        // تحديث كود خصم
        Route::post('/{discount_code}', [DiscountCodeController::class, 'update'])->name('discount-codes.update');

        // حذف كود خصم
        Route::delete('/{discount_code}', [DiscountCodeController::class, 'destroy'])->name('discount-codes.destroy');
    });

    // فواتير المشتريات
    Route::prefix('purchases')->group(function () {
        // عرض كل الفواتير
        Route::get('/', [PurchaseController::class, 'index'])->name('purchases.index');

        // إنشاء فاتورة جديدة (واجهة)
        Route::get('/create', [PurchaseController::class, 'create'])->name('purchases.create');

        // حفظ فاتورة جديدة
        Route::post('/', [PurchaseController::class, 'store'])->name('purchases.store');

        // تعديل فاتورة
        Route::get('/{purchase}/edit', [PurchaseController::class, 'edit'])->name('purchases.edit');

        // تحديث فاتورة
        Route::post('/{purchase}', [PurchaseController::class, 'update'])->name('purchases.update');

        // عرض تفاصيل فاتورة
        Route::get('/{id}', [PurchaseController::class, 'show'])->name('purchases.show');

        // حذف فاتورة
        Route::delete('/{purchase}', [PurchaseController::class, 'destroy'])->name('purchases.destroy');
    });
});




require __DIR__ . '/auth.php';
