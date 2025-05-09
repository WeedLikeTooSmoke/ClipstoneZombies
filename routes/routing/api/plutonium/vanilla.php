<?php

use App\Http\Controllers\Plutonium\VanillaController;

Route::post('/api/vanilla/account', [VanillaController::class, 'account'])->name('api.vanilla.account');
Route::post('/api/vanilla/leaderboard', [VanillaController::class, 'leaderboard'])->name('api.vanilla.leaderboard');
Route::post('/api/vanilla/stats', [VanillaController::class, 'stats'])->name('api.vanilla.stats');
Route::post('/api/vanilla/autoMessages', [VanillaController::class, 'autoMessages'])->name('api.vanilla.autoMessages');
