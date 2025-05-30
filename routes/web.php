<?php

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
    Route::resource('/jobs', JobController::class)->names('jobs')->only(['index', 'show','store']);

    Route::resource('/companies', CompanyController::class)->names('companies')->only(['show', 'create', 'store']);
    Route::get('/my-jobs', [CompanyController::class, 'index'])->name('my-jobs')->middleware(EnsureUserIsEmployer::class);
    Route::get('/my-jobs/create', [JobController::class, 'create'])->name('my-jobs.create')->middleware(EnsureUserIsEmployer::class);
    Route::get('my-jobs/{job}/edit', [JobController::class, 'edit'])->name('my-jobs.edit');
    Route::post('/my-jobs/{job}', [JobController::class, 'update'])->name('my-jobs.update');

    Route::resource('jobs.application', JobApplicationController::class)->names('jobs.application')->only(['create', 'store']);

    Route::resource('appliedJobs', JobApplicationController::class)->names('appliedJobs')->only(['index', 'destroy']);
});


require __DIR__.'/auth.php';
