<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\EventController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
});

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (): void {
    Route::get('/', [EventController::class, 'index'])->name('events.index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event:slug}/publish', [EventController::class, 'confirmPublish'])
        ->name('events.publish.confirm');
    Route::post('/events/{event:slug}/publish', [EventController::class, 'publish'])
        ->name('events.publish');
    Route::post('/logout', [AuthController::class, 'destroy'])->name('logout');
});
