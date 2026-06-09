<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseReviewController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::prefix(LaravelLocalization::setLocale())->group(
    function () {
        Route::name('front.')->group(
            function () {
                Route::get('/', [MainController::class, 'index'])->name('index');
                Route::get('slider/{slider}', [MainController::class, 'slider_show'])->name('slider_show');
                Route::get('about', [MainController::class, 'about'])->name('about');
                Route::get('course/{course}', [MainController::class, 'course_show'])->name('course_show');
                Route::get('course', [MainController::class, 'course'])->name('course');
                Route::get('team', [MainController::class, 'team'])->name('team');
                Route::get('testimonial', [MainController::class, 'testimonial'])->name('testimonial');
                Route::get('contact', [MainController::class, 'contact'])->name('contact');
                Route::post('/contact', [MainController::class, 'contact_data']);
                Route::post('subscription', [MainController::class, 'subscription'])->name('subscription');
            }
        );




        Route::middleware(['auth', 'verified', 'admin'])->group(function () {
            Route::get('/dashboard',[DashboardController::class, 'dashboard'])->name('dashboard');
            Route::prefix('admin')->name('admin.')->group(function () {
                Route::resource('sliders', SliderController::class);
                Route::resource('categories', CategoryController::class);
                Route::resource('services', ServiceController::class);
                Route::resource('teachers', TeacherController::class);

                Route::resource('teams', TeamController::class);
                Route::resource('courses', CourseController::class);
                Route::resource('lessons', LessonController::class);
                Route::resource('enrollments', EnrollmentController::class);
                Route::resource('testimonials', TestimonialController::class);
                Route::get('messages', [DashboardController::class, 'messages'])->name('messages');
                Route::delete('delete_messages/{id}', [DashboardController::class, 'delete_messages'])->name('delete_messages');
                Route::get('delete_gallery/{gallery}', [DashboardController::class, 'delete_gallery'])->name('delete_gallery');

                Route::resource('course_reviews', CourseReviewController::class);
                Route::resource('payments', PaymentController::class);
                Route::get('subscriptions', [DashboardController::class, 'subscriptions'])->name('subscriptions');
                Route::delete('delete_subscriptions/{id}', [DashboardController::class, 'delete_subscriptions'])->name('delete_subscriptions');

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