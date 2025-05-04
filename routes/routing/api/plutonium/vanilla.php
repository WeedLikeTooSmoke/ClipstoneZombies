<?php

use App\Http\Controllers\Plutonium\VanillaController;

Route::post('/api/vanilla/account', [VanillaController::class, 'account'])->name('api.vanilla.account');
