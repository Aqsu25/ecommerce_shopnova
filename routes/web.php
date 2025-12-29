<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;



// main page
Route::get('/home', [UserController::class, 'home'])->name('home');

// PRODUCT_DETAIL
Route::get('/product_detail/{id}', [ProductController::class, 'details'])->name('product.detail');

// VIEW ALL PRODUCT
Route::get('/viewallproduct', [UserController::class, 'allproducts'])->name('viewallproducts');


Route::get('/dashboard', [UserController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// add to cart
Route::post('/add_to_cart/{id}', [UserController::class, 'add_to_cart'])
    ->middleware(['auth', 'verified'])
    ->name('add_to_cart');

// cart_page
Route::get('/cart', [UserController::class, 'cartpage'])
    ->middleware(['auth', 'verified'])
    ->name('cart.page');

// cart_remove
Route::get('/cart_remove/{id}', [UserController::class, 'cartremove'])
    ->middleware(['auth', 'verified'])
    ->name('cart.remove');

// order-detail
Route::any('/order_detail', [UserController::class, 'order_detail'])
    ->middleware(['auth', 'verified'])
    ->name('order.detail');

// user view orders own
Route::get('/myorder', [UserController::class, 'my_Order'])
    ->middleware(['auth', 'verified'])
    ->name('users.orders');

// user-pdf
Route::get('/user_pdf/{id}', [UserController::class, 'downloadPdf'])
    ->middleware(['auth', 'verified'])
    ->name('users.pdf');

// product_search
Route::get('/product/user_search', [UserController::class, 'headerProductSearch'])->name('product.search');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/users', UserController::class);
    Route::resource('/permissions', PermissionController::class);
    Route::resource('/roles', RoleController::class);

    // user_ratings_store
    Route::post('/users_rating/store/{productId}', [UserController::class, 'users_rating_store'])
        ->middleware(['auth', 'verified'])
        ->name('ratings.store');
});


// admin
Route::middleware('auth', 'admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'indexCategory'])->name('admin.index');
    Route::get('/admin/category/create', [AdminController::class, 'createCategory'])->name('admin.create');
    Route::post('/admin/category/store', [AdminController::class, 'storeCategory'])->name('admin.store');
    Route::get('/admin/category/edit/{id}', [AdminController::class, 'editCategory'])->name('admin.edit');
    Route::put('/admin/category/update/{id}', [AdminController::class, 'updateCategory'])->name('admin.update');
    Route::delete('/admin/category/destroy/{id}', [AdminController::class, 'destroyCategory'])->name('admin.destroy');

    Route::any('/admin/user_search', [AdminController::class, 'searchUser'])->name('admin.usersearch');

    // product-search
    Route::any('/admin/product_search', [AdminController::class, 'searchProduct'])->name('admin.search');

    // admin-view-order
    Route::any('/admin/view_order', [AdminController::class, 'view_Order'])->name('view.order');

    // order_status
    Route::post('/admin/status/{id}', [AdminController::class, 'order_status'])->name('order.status');

    // pdf-download-admin
    Route::get('/admin/pdf/{id}', [AdminController::class, 'downloadPdf'])->name('download.pdf');


    //  product-category
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products-subcategory/{id}', [ProductController::class, 'getsubcategories'])->name('products.getsubcategories');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // subcategory
    Route::resource('/subcategory', SubCategoryController::class);

    // approve-reviews
    Route::get('/approve_rating', [ProductController::class, 'public_rating'])->name('public.rating');
    // status_change
    Route::get('/status_change/{id}', [ProductController::class, 'status_change'])->name('status.change');
});


require __DIR__ . '/auth.php';
