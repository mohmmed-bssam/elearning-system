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
use App\Http\Controllers\PaymentController as ControllersPaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\CourseReviewController as StudentCourseReviewController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Teacher\LessonController as TeacherLessonController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::prefix(LaravelLocalization::setLocale())->group(function () {
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


    Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
        Route::prefix('admin')->name('admin.')->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

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

            Route::get('notifications', [DashboardController::class, 'notifications'])->name('notifications');
            Route::get('notifications/{notification}', [DashboardController::class, 'markAsRead'])->name('notifications.markAsRead');

            Route::get('settings', [DashboardController::class, 'settings'])->name('settings');
            Route::put('settings', [DashboardController::class, 'settings_update'])->name('settings.update');

            // approve payment
            // Route::patch('/payments/{id}/approve', [PaymentController::class, 'approvePayment'])
            //     ->name('payments.approve');

            // reject payment
            // Route::patch('/payments/{id}/reject', [PaymentController::class, 'rejectPayment'])
            //     ->name('payments.reject');
        });
    });
    Route::middleware(['auth', 'role:teacher'])->group(function () {
        Route::prefix('teacher')->name('teacher.')->group(function () {
            Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('dashboard');
            Route::get('/courses', [TeacherDashboardController::class, 'courses'])->name('courses');
            Route::get('/students', [TeacherDashboardController::class, 'students'])->name('students');
            Route::resource('/lessons', TeacherLessonController::class);
            Route::get('reviews', [TeacherDashboardController::class, 'reviews'])->name('reviews');
            Route::get('notifications', [TeacherDashboardController::class, 'notifications'])->name('notifications');
            Route::get('notifications/{notification}', [TeacherDashboardController::class, 'markAsRead'])->name('notifications.markAsRead');
        });
    });
    Route::middleware(['auth', 'role:student'])->group(function () {

        Route::prefix('student')->name('student.')->group(function () {
            Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
            Route::get('/reviews', [StudentCourseReviewController::class, 'index'])
                ->name('reviews.index');

            Route::get('/reviews/create/{course}', [StudentCourseReviewController::class, 'create'])
                ->name('reviews.create');

            Route::post('/reviews', [StudentCourseReviewController::class, 'store'])
                ->name('reviews.store');
            Route::get('/lessons', [StudentDashboardController::class, 'lessons'])->name('lessons');
            Route::get('notifications', [StudentDashboardController::class, 'notifications'])->name('notifications');
            Route::get('notifications/{notification}', [StudentDashboardController::class, 'markAsRead'])->name('notifications.markAsRead');
        });
    });
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::get('checkout/{course}', [ControllersPaymentController::class, 'checkout'])
            ->name('checkout');

        Route::post('checkout/{course}', [ControllersPaymentController::class, 'store'])
            ->name('checkout.store');


    });
});


require __DIR__ . '/auth.php';
