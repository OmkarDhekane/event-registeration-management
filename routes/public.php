<?php

use App\Http\Controllers\Public\EventController;
use App\Http\Controllers\Public\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');
Route::get('/events/{event:slug}/register', [RegistrationController::class, 'create'])
    ->name('registrations.create');
Route::post('/events/{event:slug}/register', [RegistrationController::class, 'store'])
    ->name('registrations.store');
Route::get('/events/{event:slug}/confirmation', [RegistrationController::class, 'confirmation'])
    ->name('registrations.confirmation');
