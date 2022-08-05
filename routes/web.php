<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\KycController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\HasVerifiedKyc;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;

// AUthentication Routes

Route::middleware(['guest'])->group(function () {
    // routes that require user to be authenticated
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    Route::get('forgot-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forgot.password.get');
    Route::post('forgot-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forgot.password.post');
    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password/{token}', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
});

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::get('contact-us', [ContactController::class, 'index'])->name('contact');
Route::post('contact-us', [ContactController::class, 'contact']);

Route::get('about-us', [AboutController::class, 'index'])->name('about');

Route::get('jobs', [JobController::class, 'index'])->name('jobs');

Route::middleware(['auth'])->group(function () {

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('kyc-verification-1', [KycController::class, 'customer_index'])->name('customer.kyc');
    Route::post('kyc-verification-1', [KycController::class, 'customer_verify']);

    Route::get('kyc-verification-2', [KycController::class, 'candidate_index'])->name('candidate.kyc');
    Route::post('kyc-verification-2', [KycController::class, 'candidate_verify']);


    Route::middleware([HasVerifiedKyc::class])->group(function () {
        // Application Routes       
        //customer profile
        Route::get('profile', [ProfileController::class, 'profile'])->name('profile');
        Route::post('profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('profile/password-reset', [ProfileController::class, 'resetpassword'])->name('profile.resetpassword');

        // for companies to post and manage jobs and applicants
        Route::get('my-jobs', [JobController::class, 'myjobs'])->name('my-jobs');

        Route::post('jobs/delete/{id}', [JobController::class, 'delete'])->name('jobs.delete');

        Route::get('jobs/{id}/applicants', [JobController::class, 'applicants'])->name('jobs.applicants');

        Route::get('jobs/application/download/{id}', [JobController::class, 'download_cv'])->name('jobs.applicants.download');

        Route::post('jobs/application/{id}', [JobController::class, 'hire'])->name('jobs.applicants.hire');

        Route::get('post-a-job', [JobController::class, 'create'])->name('jobs.post');

        Route::post('post-a-job', [JobController::class, 'store']);

        // For candidates and guests to find and view a job
        Route::get('jobs/{id}', [JobController::class, 'detail'])->name('jobs.detail');
        Route::post('jobs/apply/{id}', [JobController::class, 'apply'])->name('jobs.apply');
    });
});

Route::post('subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');
