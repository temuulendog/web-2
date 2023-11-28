<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VerificationController;



Auth::routes(['register' => true]);
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
    return view('welcome');
});
//Route::get('/student', function () {
//    return view('studentlist');
//});


// routes/web.php


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Email verification routes
Route::get('/email/verify', [VerificationController::class, 'show'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
    ->middleware(['auth', 'signed', 'throttle:6,1'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [VerificationController::class, 'resend'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.resend');

// Book routes
Route::prefix('books')->group(function () {
    Route::get('/test', [TestController::class, 'index'])->name('books.test');
    Route::get('/create', [BookController::class, 'create'])->name('books.create');
});

Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');

Route::prefix('books')->group(function () {
    Route::get('/create', [BookController::class, 'create'])->name('books.create');
    Route::post('/store', [BookController::class, 'store'])->name('books.store');
    Route::get('/', [BookController::class, 'index'])->name('books.index');
    Route::get('/{id}', [BookController::class, 'show'])->name('books.show');
});