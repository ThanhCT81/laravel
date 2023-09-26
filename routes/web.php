<?php

use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


Route::prefix('admin')->middleware('auth.admin')->name('admin.')->group(function () {
    //User
    Route::get('user', [UserController::class, 'index'])->name('user.list');

    //Product_category
    Route::get('product_category', [ProductCategoryController::class, 'index'])->name('product_category.list');
    Route::get('product_category/add', [ProductCategoryController::class, 'create'])->name('product_category.add');
    Route::post('product_categories/store', [ProductCategoryController::class, 'store'])->name('product_category.store');
    Route::get('product_category/detail/{id}', [ProductCategoryController::class, 'detail'])->name('product_category.detail');
    Route::post('product_categories/update/{id}', [ProductCategoryController::class, 'update'])->name('product_category.update');
    Route::get('product_category/destroy/{id}', [ProductCategoryController::class, 'destroy'])->name('product_category.destroy');


    //Product
    Route::resource('product', ProductController::class);
    Route::get('prodduc/{product}/restore', [ProductController::class, 'restore'])->name('product.restore');
    Route::post('product/slug', [ProductController::class, 'createSlug'])->name('product.create.slug');
    Route::post('product-upload-image', [ProductController::class, 'uploadImage'])->name('product.image.upload');
});

Route::get('/', [HomeController::class, 'index'])->name('client.product-list');
Route::get('product/add-to-cart/{product}', [CartController::class, 'addToCart'])->name('product.add-to-cart');
Route::get('product/delete-item-from-cart/{product}', [CartController::class, 'deleteItem'])->name('product.delete-item-from-cart');
Route::get('product/update-item-from-cart/{product}/{qty?}', [CartController::class, 'updateItem'])->name('product.update-item-from-cart');
Route::get('cart', [CartController::class, 'index'])->name('cart.index');

Route::get('check', function () {
    dd(session()->get('cart'));
});
Route::get('chivas', function () {
    return 'chivas';
});
