<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseReviewController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::prefix(LaravelLocalization::setLocale())->group(
    function () {

        Route::middleware(['auth', 'verified', 'admin'])->group(function () {
            Route::get('/dashboard', function () {
                return view('dashboard');
            })->name('dashboard');
            Route::prefix('admin')->name('admin.')->group(function () {
                Route::resource('sliders', SliderController::class);
                Route::resource('categories', CategoryController::class);
                Route::resource('services', ServiceController::class);
                Route::resource('teams', TeamController::class);
                Route::resource('courses', CourseController::class);
                Route::resource('lessons', LessonController::class);
                Route::resource('enrollments', EnrollmentController::class);
                Route::resource('testimonials', TestimonialController::class);
                Route::get('messages', [DashboardController::class, 'messages'])->name('messages');
                Route::delete('delete_messages/{id}', [DashboardController::class, 'delete_messages'])->name('delete_messages');
                Route::resource('course_reviews', CourseReviewController::class);
                Route::get('subscriptions', [DashboardController::class, 'subscriptions'])->name('subscriptions');
                Route::get('settings', [DashboardController::class, 'settings'])->name('settings');
                Route::put('settings', [DashboardController::class, 'settings_update'])->name('settings.update');
            });
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
    }
);


require __DIR__ . '/auth.php';