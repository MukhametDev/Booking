<?php
use App\Http\Controllers\Auth\AdminLoginController;

// Маршрут отображения формы входа для администратора
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');

// Маршрут обработки запроса на вход для администратора
Route::post('/admin/login', [AdminLoginController::class, 'login']);

// Маршрут выхода для администратора
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

?>
