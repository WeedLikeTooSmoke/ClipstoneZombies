<?php

use App\Http\Controllers\Auth\Auth;

Route::post('/auth/login', [Auth::class, 'login'])->name('auth.login');
Route::post('/auth/register', [Auth::class, 'register'])->name('auth.register');
Route::get('/auth/logout', [Auth::class, 'logout'])->name('auth.logout');
