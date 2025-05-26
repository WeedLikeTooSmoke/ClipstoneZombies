<?php

use App\Http\Controllers\Rcon\RconVanillaController;

Route::post('sendCommand', [RconVanillaController::class, 'sendCommand'])->name('rcon.sendCommand');
