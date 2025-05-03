<?php

use App\Http\Controllers\VanillaPlutoniumController;

Route::post('/api/vanilla/account', [VanillaPlutoniumController::class, 'account'])->name('api.vanilla.account');
