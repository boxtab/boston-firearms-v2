<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CertificateBackOfficeController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\Checkout\EnterDetailsController;
use App\Http\Controllers\Checkout\MakePaymentController;
use App\Http\Controllers\Checkout\ScheduleClassController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\EventRescheduleController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\WebhookController;
use Illuminate\Support\Facades\Route;

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

Route::get('/test', ['as' => 'test.index', 'uses' => 'App\Http\Controllers\TestController@index'])
    ->middleware(['development.mode']);

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/about-us', [FrontendController::class, 'showAboutUs'])->name('about-us');
Route::get('/contact-us', [FrontendController::class, 'showContactUs'])->name('contact-us');
Route::post('/contact-us', [FrontendController::class, 'storeContactUs'])->name('contact-us.store');
Route::view('/terms-and-condition', 'pages.terms')->name('terms');
Route::view('/privacy-policy', 'pages.privacy')->name('privacy');

Route::get('/gift-cards', [FrontendController::class, 'showGiftCards'])->name('gift-cards');

Route::get('/classes', [ ClassesController::class, 'index'])->name('classes');

Route::group(['prefix' => 'schedule-class', 'as' => 'class.'], function () {
    Route::get('/{event:slug}', [ ClassController::class, 'index'])->name('page');
    Route::post('/signup-via-contact-form', [ClassController::class, 'classContactFormSignUp'])->name('sign-up-via-contact-form');
});

Route::group(['prefix' => 'calendar', 'as' => 'calendar.'], function(){
    Route::get('/appointments/{event}/{period?}', [CalendarController::class, 'getAppointments'])->name('appointments.ajax');
});


Route::group(['prefix' => 'checkout', 'as' => 'checkout.'], function() {
    Route::get('/schedule-class/{event:slug?}', [ScheduleClassController::class, 'show'])->name('schedule-class.show');
    Route::post('/schedule-class', [ScheduleClassController::class, 'store'])->name('schedule-class.store');

    Route::get('/{appointment}/enter-details', [EnterDetailsController::class, 'show'])->name('enter-details.show');
    Route::post('/{appointment}/enter-details', [EnterDetailsController::class, 'store'])->name('enter-details.store');
});

Route::group(['prefix' => 'certificate', 'as' => 'certificate.'], function () {
    Route::view('search', 'pages.certificate.search')->name('search.show');

    Route::get('/{booking}/payment', [CertificateController::class, 'paymentShow'])->name('payment.show');
    Route::post('/{booking}/payment', [CertificateController::class, 'purchase'])->name('payment.store');

    Route::group(['middleware' => ['auth', 'check.admin.instructor']], function () {
        Route::get('/appointment/{appointment}/{downloadType}/export', [CertificateBackOfficeController::class, 'classCertificate'])
            ->name('appointment.export');
        Route::get('/booking/{booking}/{downloadType}/export', [CertificateBackOfficeController::class, 'studentCertificate'])
            ->name('booking.export');
    });
    Route::get('/payment/{booking}/{downloadType}/export', [CertificateController::class, 'frontCertificate'])
        ->name('payment.export');
});

Route::group(['prefix' => 'webhook'], function () {
    Route::any('/smartwaiver', [WebhookController::class, 'retrieveWaiver']);
});

Route::group(['prefix' => 'reschedule', 'as' => 'event-reschedule.'], function () {
    Route::get('/{bookingHash}', [EventRescheduleController::class, 'show'])->name('show');
    Route::get('/{bookingHash}/{appointment}', [EventRescheduleController::class, 'changeBooking'])->name('ajax-change');
});
