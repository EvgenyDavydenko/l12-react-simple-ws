<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestBroadcastController;
use Illuminate\Support\Facades\Route;

// ---------------------------------------------------------------
// Diagnostics
// ---------------------------------------------------------------
Route::post('diagnostics/broadcast-test', TestBroadcastController::class)
    ->name('diagnostics.broadcast-test');

// ---------------------------------------------------------------
// Authentication (API - Session-based for SPA)
// ---------------------------------------------------------------
// Login endpoint - establishes session cookie for SPA
Route::post('login', [AuthController::class, 'login'])->name('api.login');

// Logout endpoint - destroys session and clears cookies
Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');

// Token-based authentication (for Postman / third parties). Returns a
// Sanctum Personal Access Token that can be used as `Authorization: Bearer <token>`.
Route::post('auth/token/create', [AuthController::class, 'tokenCreate'])->name('auth.token.create');

// ---------------------------------------------------------------
// Protected API using Sanctum (tokens or session when stateful)
// ---------------------------------------------------------------
Route::middleware('auth:sanctum')->group(function (): void {
    // Session or token-authenticated user info (SPA uses this; works with cookies or tokens)
    Route::get('auth/me', [AuthController::class, 'me'])->name('auth.me');
});
