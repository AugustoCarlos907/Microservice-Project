<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::resource('users', UserController::class);

// Endpoint interno, usado pelo serviço Orders (Symfony) para validar um usuário.
// Protegido pelo middleware service.auth (header X-Service-Token).
Route::middleware('service.auth')->group(function () {
    Route::get('/internal/users/{id}/exists', [UserController::class, 'existsCheck']);
});