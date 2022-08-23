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
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MessageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// Email verification Routes

Route::get('/email/verify', function () {
    if (!auth()->user()->hasVerifiedEmail()) {
        return view('auth.verify-email');
    }
    return redirect()->route('homepage');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {

    $request->fulfill();

    if (auth()->user()->role->name == 'candidate') {
        return redirect()->route('homepage')->with('success', 'Enjoy the application crafted beautifully just for you 😉');
    }

    return redirect()->route('my-jobs')->with('success', 'Enjoy the application crafted beautifully just for you. Verify the KYC first though.');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::middleware(['guest'])->group(function () {
    // routes that require user to be authenticated
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->middleware("throttle:3,1");

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
Route::get('jobs/search', [JobController::class, 'search'])->name('jobs.search');

Route::get('candidates/search', [CandidateController::class, 'search'])->name('candidates.search');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'verified', 'banned'])->group(function () {

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

        Route::post('my-jobs/delete/{id}', [JobController::class, 'delete'])->name('jobs.delete');

        Route::get('my-jobs/{id}/applicants', [JobController::class, 'applicants'])->name('jobs.applicants');

        // for candidate
        Route::get('applied-jobs', [JobController::class, 'applied_jobs'])->name('jobs.applied');

        // for customer
        Route::get('my-jobs/application/download/{id}', [JobController::class, 'download_cv'])->name('jobs.applicants.download');

        Route::post('my-jobs/application/{id}/accept', [JobController::class, 'accept'])->name('jobs.applicants.accept');

        Route::post('my-jobs/application/{id}/reject', [JobController::class, 'reject'])->name('jobs.applicants.reject');

        Route::get('my-jobs/post-a-job', [JobController::class, 'create'])->name('jobs.post');

        Route::post('my-jobs/post-a-job', [JobController::class, 'store']);

        Route::get('my-jobs/edit-a-job/{id}', [JobController::class, 'edit'])->name('jobs.edit');

        Route::post('my-jobs/edit-a-job/{id}', [JobController::class, 'update']);

        // read feedbacks 
        Route::get('my-jobs/feedbacks/{id}', [JobController::class, 'feedbacks'])->name('jobs.feedbacks');

        // For candidates to find and view a job
        Route::get('find-a-job', [JobController::class, 'findAJob'])->name('find-a-job');
        Route::get('jobs/{id}', [JobController::class, 'detail'])->name('jobs.detail');
        Route::post('jobs/apply/{id}', [JobController::class, 'apply'])->name('jobs.apply');
        Route::post('jobs/feedback/{job_id}', [JobController::class, 'feedback'])->name('jobs.feedback.create');

        // messaging customer
        Route::get('jobs/{job_id}/message/{applicant_id}', [MessageController::class, 'customer_messages'])->name('jobs.applicants.message');
        Route::post('jobs/{job_id}/message/{applicant_id}', [MessageController::class, 'store_message_from_customer']);

        // messaging candidate
        Route::get('applied-jobs/{job_id}/message/{applicant_id}', [MessageController::class, 'candidate_messages'])->name('jobs.candidates.message');
        Route::post('applied-jobs/{job_id}/message/{applicant_id}', [MessageController::class, 'store_message_from_candidate']);
    });
});

Route::post('subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe');

Route::get('test', [SubscriptionController::class, 'test']);
