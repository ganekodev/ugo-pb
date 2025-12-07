<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PBController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PartnerVerifiedController;
use App\Http\Controllers\PartnerUnverifiedController;

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    return "Cleared!";
});

Route::redirect('/', 'dashboard');
Route::redirect('/home', 'dashboard');
Route::get('/login', [LoginController::class, 'index'])->name('login');

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/dashboard',                [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/change-password',          [PBController::class, 'changePassword'])->name('change-password');
    Route::put('/change-password/{id}',     [PBController::class, 'updatePassword'])->name('update-password');
    Route::prefix('partner')->group(function () {
        Route::get('/export/{title}',       [PartnerController::class, 'partner_export'])->name('partner.export');
        Route::get('/equipment',            [PartnerController::class, 'partner_equipment'])->name('partner.equipment');
        Route::post('/verify/{id}',         [PartnerController::class, 'verify_partner'])->name('partner.verify');
        Route::get('/unverified',           [PartnerController::class, 'unverified_index'])->name('partner.unverified.index');
        Route::get('/unverified/{id}',      [PartnerController::class, 'unverified_show'])->name('partner.unverified.show');
        Route::get('/verified',             [PartnerController::class, 'verified_index'])->name('partner.verified.index');
        Route::get('/verified/{id}',        [PartnerController::class, 'verified_show'])->name('partner.verified.show');
        Route::get('/traction',             [PartnerController::class, 'traction_index'])->name('partner.traction.index');
        Route::get('/cashflow',             [PartnerController::class, 'cashflow_index'])->name('partner.cashflow.index');
    });
    Route::prefix('pb')->group(function () {
        Route::get('/cashflow',             [PBController::class, 'cashflow_index'])->name('pb.cashflow.index');
        Route::get('/withdraw',             [PBController::class, 'withdraw_index'])->name('pb.withdraw.index');
    });
});
