<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\QnaController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\FavoriteController;
use App\Http\Controllers\Frontend\HomePageController;
use App\Http\Controllers\Frontend\LearningController;
use App\Http\Controllers\Frontend\AboutPageController;
use App\Http\Controllers\Frontend\CoursePageController;
use App\Http\Controllers\Global\CloudStorageController;
// use App\Http\Controllers\Frontend\StudentOrderController; // Removed - system is now free
use App\Http\Controllers\Frontend\CourseContentController;
use App\Http\Controllers\Frontend\StudentReviewController;

use App\Http\Controllers\Frontend\StudentDashboardController;
use App\Http\Controllers\Frontend\TinymceImageUploadController;
use App\Http\Controllers\Frontend\StudentProfileSettingController;

Route::group(['middleware' => 'maintenance.mode'], function () {

    /**
     * ============================================================================
     * Global Routes
     * ============================================================================
     */

    Route::get('set-language', [DashboardController::class, 'setLanguage'])->name('set-language');
    Route::get('set-currency', [HomePageController::class, 'setCurrency'])->name('set-currency');

    // Redirect root to login page since project starts from login
    Route::get('/', function () {
        return redirect()->route('login');
    })->name('home');

    Route::get('countries', [HomePageController::class, 'countries'])->name('countries');
    Route::get('states/{country_id}', [HomePageController::class, 'states'])->name('states');
    Route::get('cities/{state_id}', [HomePageController::class, 'cities'])->name('cities');

    // Course routes - accessible after login
    Route::get('courses', [CoursePageController::class, 'index'])->name('courses');
    Route::get('fetch-courses', [CoursePageController::class, 'fetchCourses'])->name('fetch-courses');
    Route::get('course/{slug}', [CoursePageController::class, 'show'])->name('course.show');

    // Removed cart routes - system is now free
    // Route::get('cart', [CartController::class, 'index'])->name('cart');
    // Route::post('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add-to-cart');
    // Route::get('remove-cart-item/{rowId}', [CartController::class, 'removeCartItem'])->name('remove-cart-item');
    // Route::post('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply-coupon');
    // Route::get('remove-coupon', [CartController::class, 'removeCoupon'])->name('remove-coupon');

    /** Blog Routes - keeping for admin content management */
    Route::get('blog', [BlogController::class, 'index'])->name('blogs');
    Route::get('blog/{slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::post('blog/submit-comment', [BlogController::class, 'submitComment'])->name('blog.submit-comment');

    Route::post('quick-connect/{id}', [HomePageController::class, 'quickConnect'])->name('quick-connect');

    // Contact routes - accessible after login
    // Route::get('about-us', [AboutPageController::class, 'index'])->name('about-us');
    Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('contact/send-mail', [ContactController::class, 'sendMail'])->name('contact.send-mail');

    /** Custom pages */
    Route::get('page/{slug}', [HomePageController::class, 'customPage'])->name('custom-page');

    /** other routes */
    Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth:admin'], 'as' => 'admin.'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
    Route::group(['prefix' => 'frontend-filemanager', 'middleware' => ['web']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::get('change-theme/{name}', [HomePageController::class, 'changeTheme'])->name('change-theme');

    /**
     * ============================================================================
     * Student Dashboard Routes
     * ============================================================================
     */

    Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'student', 'as' => 'student.'], function () {
        Route::get('dashboard', [StudentDashboardController::class, 'index'])->name('dashboard');
        // Profile setting routes
        Route::get('setting', [StudentProfileSettingController::class, 'index'])->name('setting.index');
        Route::put('setting/profile', [StudentProfileSettingController::class, 'updateProfile'])->name('setting.profile.update');
        Route::put('setting/bio', [StudentProfileSettingController::class, 'updateBio'])->name('setting.bio.update');
        Route::put('setting/password', [StudentProfileSettingController::class, 'updatePassword'])->name('setting.password.update');
        Route::get('setting/experience-modal', [StudentProfileSettingController::class, 'showExperienceModal'])->name('setting.experience-modal');
        Route::get('setting/edit-experience-modal/{id}', [StudentProfileSettingController::class, 'editExperienceModal'])->name('setting.edit-experience-modal');

        Route::post('setting/experience', [StudentProfileSettingController::class, 'storeExperience'])->name('setting.experience.store');
        Route::put('setting/experience/{id}', [StudentProfileSettingController::class, 'updateExperience'])->name('setting.experience.update');
        Route::delete('setting/experience/{id}', [StudentProfileSettingController::class, 'destroyExperience'])->name('setting.experience.destroy');

        Route::get('setting/add-education-modal', [StudentProfileSettingController::class, 'addEducationModal'])->name('setting.add-education-modal');
        Route::post('setting/education', [StudentProfileSettingController::class, 'storeEducation'])->name('setting.education.store');
        Route::get('setting/edit-education-modal/{id}', [StudentProfileSettingController::class, 'editEducationModal'])->name('setting.edit-education-modal');
        Route::put('setting/education/{id}', [StudentProfileSettingController::class, 'updateEducation'])->name('setting.education.update');
        Route::delete('setting/education/{id}', [StudentProfileSettingController::class, 'destroyEducation'])->name('setting.education.destroy');

        Route::put('setting/address', [StudentProfileSettingController::class, 'updateAddress'])->name('setting.address.update');
        Route::put('setting/socials', [StudentProfileSettingController::class, 'updateSocials'])->name('setting.socials.update');

        /** Order Routes - Removed since system is now free */
        // Route::get('orders', [StudentOrderController::class, 'index'])->name('orders.index');
        // Route::get('order-details/{id}', [StudentOrderController::class, 'show'])->name('order.show');
        // Route::get('order/invoice/{id}', [StudentOrderController::class, 'printInvoice'])->name('order.print-invoice');

        Route::get('reviews', [StudentReviewController::class, 'index'])->name('reviews.index');
        Route::get('reviews/{id}', [StudentReviewController::class, 'show'])->name('reviews.show');
        Route::delete('reviews/{id}', [StudentReviewController::class, 'destroy'])->name('reviews.destroy');
        Route::get('enrolled-courses', [StudentDashboardController::class, 'enrolledCourses'])->name('enrolled-courses');
        Route::get('course-history', [StudentDashboardController::class, 'courseHistory'])->name('course-history');
        Route::get('quiz-attempts', [StudentDashboardController::class, 'quizAttempts'])->name('quiz-attempts');
        
        /** Course enrollment route */
        Route::post('enroll-course', [StudentDashboardController::class, 'enrollCourse'])->name('enroll-course');

        /** Chat and Meetings routes */
        Route::get('chat', [StudentDashboardController::class, 'chat'])->name('chat');
        Route::get('meetings', [StudentDashboardController::class, 'meetings'])->name('meetings');

        /** learning routes */
        Route::get('learning/{slug}', [LearningController::class, 'index'])->name('learning.index');
        Route::post('learning/get-file-info', [LearningController::class, 'getFileInfo'])->name('get-file-info');
        Route::post('learning/make-lesson-complete', [LearningController::class, 'makeLessonComplete'])->name('make-lesson-complete');
        Route::get('learning/resource-download/{id}', [LearningController::class, 'downloadResource'])->name('download-resource');

        Route::get('learning/quiz/{id}', [LearningController::class, 'quizIndex'])->name('quiz.index');
        Route::post('learning/quiz/{id}', [LearningController::class, 'quizStore'])->name('quiz.store');
        Route::get('learning/quiz-result/{id}/{result_id}', [LearningController::class, 'quizResult'])->name('quiz.result');
        Route::get('learning/{slug}/{lesson_id}', [LearningController::class, 'liveSession'])->name('learning.live');

        /** qna routes */
        Route::post('create-question', [QnaController::class, 'create'])->name('qna.create');
        Route::get('fetch-lesson-questions', [QnaController::class, 'fetchLessonQuestions'])->name('fetch-lesson-questions');
        Route::post('create-reply', [QnaController::class, 'createReply'])->name('create-reply');
        Route::get('fetch-replies', [QnaController::class, 'fetchReply'])->name('fetch-replies');

        Route::delete('delete-question/{id}', [QnaController::class, 'destroyQuestion'])->name('destroy-question');
        Route::delete('delete-reply/{id}', [QnaController::class, 'destroyReply'])->name('destroy-reply');

        /** course review Routes */
        Route::post('add-review', [LearningController::class, 'addReview'])->name('add-review');
        Route::get('fetch-reviews/{course_id}', [LearningController::class, 'fetchReviews'])->name('fetch-reviews');

        /** download certificate route */
        Route::get('download-certificate/{id}', [StudentDashboardController::class, 'downloadCertificate'])->name('download-certificate');
        Route::view('wishlist', 'frontend.wishlist.index')->name('wishlist');

    });

    /**
     * ============================================================================
     * Instructor Dashboard Routes
     * ============================================================================
     */

    // Redirect /instructor to /instructor/dashboard
    Route::get('instructor', function () {
        return redirect()->route('instructor.dashboard');
    })->middleware(['auth', 'verified']);

    Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'instructor', 'as' => 'instructor.'], function () {
        Route::get('dashboard', [App\Http\Controllers\Frontend\InstructorDashboardController::class, 'index'])->name('dashboard');
        Route::get('chat', [App\Http\Controllers\Frontend\InstructorDashboardController::class, 'chat'])->name('chat');
        Route::get('meetings', [App\Http\Controllers\Frontend\InstructorDashboardController::class, 'meetings'])->name('meetings');
        Route::get('analytics', [App\Http\Controllers\Frontend\InstructorDashboardController::class, 'analytics'])->name('analytics');
        Route::get('ai-summary', [App\Http\Controllers\Frontend\InstructorDashboardController::class, 'aiSummary'])->name('ai-summary');
    });


    /** wishlist routes */
    Route::group(['middleware' => ['auth', 'verified']], function () {
        Route::controller(FavoriteController::class)->group(function () {
            Route::get('wishlist/{course:slug}', 'update')->name('wishlist.update');
            Route::delete('wishlist/{course:slug}', 'destroy')->name('wishlist.remove');
        });
        /** secure-video route */
        Route::get('secure-video/{hash}', App\Http\Controllers\SecureLinkPreviewController::class)->name('secure.video')->middleware('signed');
    });

    Route::group(['middleware' => ['auth', 'verified']], function () {
        Route::get('checkout', [CheckOutController::class, 'index'])->name('checkout.index');
        Route::post('tinymce-upload-image', [TinymceImageUploadController::class, 'upload']);
        Route::delete('tinymce-delete-image', [TinymceImageUploadController::class, 'destroy']);
    });
});

//maintenance mode route
Route::get('/maintenance-mode', function () {
    $setting = Illuminate\Support\Facades\Cache::get('setting', null);
    if (!$setting?->maintenance_mode) {
        return redirect()->route('home');
    }

    return view('global.maintenance');
})->name('maintenance.mode');

require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';