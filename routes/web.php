<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// trang chủ
Route::get('/',function(){
    return view('client.home');
});

// login
Route::get('/login',function(){
    return view ('auth.login');
})->name('login');
Route::post('/login',[AuthController::class,'login']);

// phân quyền cho client
Route::middleware('client')->group(function(){
    Route::get('/list',function(){
        return view('client.list');
    });
});

//logout
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

// phân quyền dành cho admin
Route::middleware('admin')->group(function(){
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);
});

