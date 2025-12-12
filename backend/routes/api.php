<?php

use App\Http\Controllers\TestBroadcastController;
use Illuminate\Support\Facades\Route;

// ---------------------------------------------------------------
// Diagnostics
// ---------------------------------------------------------------
Route::post('diagnostics/broadcast-test', TestBroadcastController::class)
    ->name('diagnostics.broadcast-test');
