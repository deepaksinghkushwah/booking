<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\PayumoneyController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\BookingController;
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

Route::get('/', function () {
    return view('home');
})->name('home');

/* Users */
Route::group(['middleware' => ['auth'], 'prefix' => 'user'], function () {
    Route::get('dashboard', [App\Http\Controllers\MemberController::class, 'dashboard'])->name('user-dashboard');
    Route::get('logout', [CustomAuthController::class, 'logout'])->name('logout');
    Route::get('admin-dashboard', [Modules\Admin\Http\Controllers\AdminController::class, 'index'])->name('admin-dashboard');
});

/* Bookings */
Route::group(['middleware' => ['auth', 'role:Booking'], 'prefix' => 'booking'], function () {    
    Route::get('show-slots-form', [BookingController::class, 'showSlots'])->name('booking-show-slots-form');
    Route::post('save-slots', [BookingController::class, 'saveSlots'])->name('save-slots');
    Route::get('list-dates-slots', [BookingController::class, 'listDateSlots'])->name('booking-list-date-slots');

    Route::get('list', [BookingController::class, 'listBooking'])->name('booking-list');
    
    Route::get('show-booking-settings', [BookingController::class, 'showBookingSettings'])->name('booking-show-settings');
    Route::post('save-booking-settings', [BookingController::class, 'saveBookingSettings'])->name('booking-save-settings');    
    
    Route::get('cancel/{id}', [BookingController::class, 'cancelBooking'])->name('booking-cancel');
});

/* Appointments */
Route::group(['middleware' => ['auth','role_or_permission:Registered|appointment-list-user|appointment-list'], 'prefix' => 'appointment'], function(){
    Route::get("index",[AppointmentController::class, 'index'])->name("appointment.index");
    Route::get("show-slots",[AppointmentController::class, 'showSlots'])->name("appointment.show-slots");
    Route::get("step1",[AppointmentController::class, 'step1'])->name("appointment.step1");
});

/* Razorpay */
Route::group(['middleware' => ['auth'], 'prefix' => 'razorpay'], function () {    
   Route::post('index', [RazorpayController::class, 'index'])->name('razorpay.index');
   Route::get('success/{id}',[RazorpayController::class, 'success'])->name('razorpay.success');
   Route::get('error',[RazorpayController::class, 'error'])->name('razorpay.error');
   Route::get('cancel/{id}',[RazorpayController::class, 'cancel'])->name('razorpay.cancel');
   
   Route::post('verify',[RazorpayController::class, 'verify'])->name('razorpay.verify');
   
   
});

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('login', [CustomAuthController::class, 'loginPost'])->name('login.post');
Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('registration', [CustomAuthController::class, 'registrationPost'])->name('register.post');
