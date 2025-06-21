<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\EnsureUserIsEmployer;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/jobs', JobController::class)->names('jobs')->only(['index','store']);
    Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show')->middleware('log_job_view');

    Route::resource('/companies', CompanyController::class)->names('companies')->only(['show', 'create', 'store']);
    Route::get('/my-jobs', [CompanyController::class, 'index'])->name('my-jobs')->middleware(EnsureUserIsEmployer::class);
    Route::get('/my-jobs/create', [JobController::class, 'create'])->name('my-jobs.create')->middleware(EnsureUserIsEmployer::class);
    Route::get('my-jobs/{job}/edit', [JobController::class, 'edit'])->name('my-jobs.edit');
    Route::post('/my-jobs/{job}', [JobController::class, 'update'])->name('my-jobs.update');
    Route::get('/my-jobs/{job}', [JobController::class, 'manage'])->name('my-jobs.manage');

    Route::resource('jobs.application', JobApplicationController::class)->names('jobs.application')->only(['create', 'store']);
    Route::resource('jobs.application', JobApplicationController::class)->names('jobs.application')->only(['show'])->shallow();

    Route::resource('appliedJobs', JobApplicationController::class)->names('appliedJobs')->only(['index']);
    Route::put('appliedJobs/{jobApplication}', [JobApplicationController::class, 'withdraw'])->name('appliedJobs.withdraw');

    Route::get('/downloadApplicantcv/{jobApplication}', [JobApplicationController::class, 'downloadApplicantcv'])->name('downloadApplicantcv');
    Route::get('/viewApplicantcv/{jobApplication}', [JobApplicationController::class, 'viewApplicantcv'])->name('viewApplicantcv');


});

Route::middleware(['auth','is_admin'])->group(function () {
    Route::get('/admin', [AdminDashboardController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('/admin/users', [AdminDashboardController::class, 'users'])->name('admin-users');
    Route::post('/setUserStatus', [ProfileController::class, 'setUserStatus'])->name('setUserStatus');
    Route::get('/export/userData/{user}', [\App\Http\Controllers\ExportsController::class, 'exportUserData'])->name('export.userData');
});





require __DIR__.'/auth.php';
