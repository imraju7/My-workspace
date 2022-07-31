<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KycController;
use App\Http\Middleware\HasVerifiedKyc;
use Illuminate\Support\Facades\Route;

// AUthentication Routes
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

Route::get('forgot-password', [ForgotPasswordController::class, 'index'])->name('forgot-password');


Route::middleware(['auth'])->group(function () {

    Route::get('kyc-verification-1', [KycController::class, 'customer_index'])->name('customer.kyc');
    Route::get('kyc-verification-2', [KycController::class, 'candidate_index'])->name('candidate.kyc');

    Route::middleware([HasVerifiedKyc::class])->group(function () {
        // Application Routes       
        Route::get('/', [HomeController::class, 'index'])->name('homepage');
        Route::get('contact-us', [HomeController::class, 'index'])->name('contact');
        Route::get('about-us', [HomeController::class, 'index'])->name('about');
        Route::get('post-a-job', [HomeController::class, 'index'])->name('jobs.post');
        Route::get('jobs', [HomeController::class, 'index'])->name('jobs');
        Route::get('jobs/{slug}', [HomeController::class, 'index'])->name('jobs.detail');
    });
});
