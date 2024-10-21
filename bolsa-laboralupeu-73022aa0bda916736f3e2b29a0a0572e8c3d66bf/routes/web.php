<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;

// Ruta de la página de inicio (home)
Route::get('/', function () {
    return view('welcome'); // Asegúrate de tener una vista llamada 'welcome'
})->name('home');

// Ruta de inicio de sesión con método POST para manejar el formulario
Route::post('login', [LoginController::class, 'login'])->name('login.post');

// Ruta para mostrar la página de espera de aprobación
Route::get('/waiting-for-approval', function () {
    return view('auth.waiting_for_approval');
})->name('approval.wait');

// Ruta para el dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Rutas personalizadas para gestión de usuarios
Route::get('usuarios/pending', [UsuarioController::class, 'pending'])->name('usuarios.pending');
Route::patch('usuarios/{id}/approve', [UsuarioController::class, 'approve'])->name('usuarios.approve');

// Rutas RESTful para gestión de usuarios
Route::resource('usuarios', UsuarioController::class)->names([
    'index' => 'usuarios.index',
    'create' => 'usuarios.create',
    'store' => 'usuarios.store',
    'show' => 'usuarios.show',
    'edit' => 'usuarios.edit',
    'update' => 'usuarios.update',
    'destroy' => 'usuarios.destroy',
]);

Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

