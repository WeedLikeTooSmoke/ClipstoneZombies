<?php

use App\Http\Controllers\Plutonium\VanillaController;

Route::post('/api/vanilla/account', [VanillaController::class, 'account'])->name('api.vanilla.account');
Route::post('/api/vanilla/getAccount', [VanillaController::class, 'getAccount'])->name('api.vanilla.getAccount');
Route::post('/api/vanilla/leaderboards', [VanillaController::class, 'leaderboards'])->name('api.vanilla.leaderboards');
Route::post('/api/vanilla/statistics', [VanillaController::class, 'statistics'])->name('api.vanilla.statistics');
Route::post('/api/vanilla/messages', [VanillaController::class, 'messages'])->name('api.vanilla.messages');
