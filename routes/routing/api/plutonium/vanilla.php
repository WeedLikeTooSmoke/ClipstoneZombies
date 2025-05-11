<?php

use App\Http\Controllers\Plutonium\VanillaController;

Route::post('/api/vanilla/account', [VanillaController::class, 'account'])->name('api.vanilla.account');
Route::post('/api/vanilla/leaderboards', [VanillaController::class, 'leaderboards'])->name('api.vanilla.leaderboards');
Route::post('/api/vanilla/statistics', [VanillaController::class, 'statistics'])->name('api.vanilla.statistics');
Route::post('/api/vanilla/autoMessages', [VanillaController::class, 'autoMessages'])->name('api.vanilla.autoMessages');
