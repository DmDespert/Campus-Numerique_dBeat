<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',
    [ProductController::class, 'index']
);

Route::get('/products/{product}',
    [ProductController::class, 'show']
);

Route::get('/categories',
    [CategoryController::class, 'index']
);

Route::get('/categories/{category}',
    [CategoryController::class, 'show']
);

Route::get('/cart',
    [CartController::class, 'index']
);
