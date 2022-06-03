<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\listingController;

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

Route::get('/', function () {
    return view('layout');
});


Route::get('/', [listingController::class, 'index']);
Route::get('listings/create', [listingController::class, 'create'])->middleware('auth');
Route::get('/listings/manage', [listingController::class, 'manage'])->middleware('auth');
Route::get('/listings/{listing}', [listingController::class, 'show']);
Route::post('/listings', [listingController::class, 'store'])->middleware('auth');;
//edit
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');;
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');;
Route::delete('/listings/{listing}', [ListingController::class, 'destory'])->middleware('auth');;

Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/users', [UserController::class, 'store']);

Route::post('/logout', [UserController::class, 'logout']);

Route::get('/users/login', [UserController::class, 'login'])->name('login')->middleware('guest');
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

