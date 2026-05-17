<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class,'home'])->name('home');
Route::get('/search', [PageController::class,'search'])->name('search');
Route::get('/wisata/{slug}', [PageController::class,'city'])->name('city.show');

Route::middleware('guest')->group(function(){
    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/login',[AuthController::class,'doLogin'])->name('login.post');
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::post('/register',[AuthController::class,'doRegister'])->name('register.post');
    Route::get('/forgot-password',[AuthController::class,'forgot'])->name('password.request');
    Route::post('/forgot-password',[AuthController::class,'forgotSent'])->name('password.email');
});

Route::middleware('auth')->group(function(){
    Route::post('/logout',[AuthController::class,'logout'])->name('logout');

    Route::middleware('active.account')->group(function(){
        Route::post('/favorite/{destination}',[PageController::class,'toggleFavorite'])->name('favorite.toggle');
        Route::get('/favorite',[PageController::class,'favorite'])->name('favorite');
        Route::get('/jadwal',[PageController::class,'schedule'])->name('schedule');
        Route::get('/notifikasi',[PageController::class,'notifications'])->name('notifications');
        Route::get('/profile',[PageController::class,'profile'])->name('profile');
        Route::get('/profile/edit',[PageController::class,'editProfile'])->name('profile.edit');
        Route::post('/profile/edit',[PageController::class,'updateProfile'])->name('profile.update');
        Route::get('/profile/password',[PageController::class,'password'])->name('profile.password');
        Route::post('/profile/password',[PageController::class,'updatePassword'])->name('profile.password.update');
        Route::get('/profile/history',[PageController::class,'history'])->name('profile.history');
        Route::get('/setting',[PageController::class,'settings'])->name('settings');
        Route::get('/bantuan/{tab?}',[PageController::class,'help'])->name('help');
        Route::post('/laporan',[PageController::class,'reportStore'])->name('report.store');
        Route::get('/payment/destination/{destination}',[PaymentController::class,'create'])->name('payment.create');
        Route::get('/payment/{order}',[PaymentController::class,'show'])->name('payment.show');
        Route::post('/payment/{order}/confirm',[PaymentController::class,'confirm'])->name('payment.confirm');
        Route::get('/payment/{order}/success',[PaymentController::class,'success'])->name('payment.success');

        Route::get('/admin',[AdminController::class,'dashboard'])->name('admin.dashboard');
        Route::get('/admin/users',[AdminController::class,'users'])->name('admin.users');
        Route::post('/admin/users/{user}/ban',[AdminController::class,'ban'])->name('admin.users.ban');
        Route::get('/admin/reports',[AdminController::class,'reports'])->name('admin.reports');
        Route::post('/admin/reports/{report}',[AdminController::class,'reportUpdate'])->name('admin.reports.update');
    });
});
