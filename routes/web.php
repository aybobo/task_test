<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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
    return view('auth.login');
})->name('index')->middleware('guest');
Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::view('/forgot-password', 'auth.forgot-password')->middleware('guest')->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'post'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.passwords.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'update'])->middleware('guest')->name('password.update');
Route::middleware(['auth'])->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('home');
        Route::post('/home', 'store')->name('post.task');
        Route::get('/task/{id}', 'show')->name('task.edit');
        Route::put('/task/{id}', 'update')->name('task.update');
        Route::delete('/task/{id}', 'destroy')->name('task.delete');
    });
});