<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegistrationController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\GoogleLoginController;
use App\Http\Controllers\Auth\UsersRecordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

/* Login and Registration */
Route::get('/register',[LoginRegistrationController::class, 'register'])->name('register');
Route::post('/store',[LoginRegistrationController::class, 'store'])->name('store');
Route::get('/login',[LoginRegistrationController::class, 'login'])->name('login');
Route::post('/authenticate',[LoginRegistrationController::class, 'authenticate'])->name('authenticate');
Route::get('/dashboard',[LoginRegistrationController::class, 'dashboard'])->name('dashboard');
Route::post('/logout',[LoginRegistrationController::class, 'logout'])->name('logout');


/* Forget and Reset Pssword */
Route::get('/forgotpassword',[ForgotPasswordController::class, 'forgotPasswordForm'])->name('forgotpassword');
Route::post('/forgotpassword',[ForgotPasswordController::class, 'submitForgotPassword'])->name('submit.forgot.password');
Route::get('/reset-password/{token}',[ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password',[ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

/* Google Social Login */
Route::get('/login/google',[GoogleLoginController::class, 'redirect'])->name('login.google-redirect');
Route::get('/login/google/callback',[GoogleLoginController::class, 'callback'])->name('login.google-callback');

/* Sidebar */
Route::get('/usersrecordtable',[UsersRecordController::class, 'usersRecordTable'])->name('usersrecordtable');
Route::get('/usersrecordtable',[UsersRecordController::class, 'showUsersRecord'])->name('usersrecordtable');
Route::delete('/deleteusersrecordtable/{id}',[UsersRecordController::class, 'deleteUsersRecord'])->name('deleteusersrecordtable');
Route::get('/editusersrecord/{id}',[UsersRecordController::class, 'editUsersRecord'])->name('editusersrecord');
Route::post('/updateusersrecord/{id}',[UsersRecordController::class, 'updateUsersRecord'])->name('updateusersrecord');