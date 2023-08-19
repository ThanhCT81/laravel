<?php

use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('home', function () {
    return view('client.pages.home');
});
Route::get('template', function () {
    return view('client.layout.master');
});
Route::get('master', function () {
    return view('client.layout.master');
});
Route::get('product1', function () {
    return view('client.pages.product.list');
});
Route::get('blog/detail', function () {
    return view('client.pages.blog.detail');
});
Route::get('test1', function () {
    return view('test1');
});
Route::get('product', function (Request $request) {
    echo '<h1>product</h1>' . $request->query('name');
});

//http://127.0.0.1:8000/product/detail/1
//http://127.0.0.1:8000/product/detail/1/hihi
Route::get('product/detail/{id}/{name?}', function ($id, $name = '') {
    echo 'Product detail ' . $id . $name;
});
