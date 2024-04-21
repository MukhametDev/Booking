<?php

use App\Http\Controllers\AdminAuditoriumsController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\AuditoriumController;
use App\Http\Controllers\auditPanel;
use App\Http\Controllers\AuditPanelController;
use App\Http\Controllers\BookingController;
use App\Http\Middleware\AdminAuthenticated;
use App\Http\Controllers\BookingAuditoriumController;
use App\Http\Controllers\supportPanelController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/login', [AdminAuthController::class, 'getLogin'])->name('admin/login');
    Route::post('/login', [AdminAuthController::class, 'postLogin']);
    Route::get('/dashboard',[AdminDashboardController::class,'showAllUsers'])->name('admin/dashboard');
    Route::get('/auditoriums',[AdminAuditoriumsController::class,'showAuditoriums'])->name('admin/auditoriums');
    Route::post('/auditoriums',[AdminAuditoriumsController::class,'store'])->name('admin/auditoriums/store');
    Route::put('/users/{user}', [AdminUsersController::class, 'updateRole'])->name('admin.users.updateRole');
    Route::get('/users',[AdminUsersController::class,'showAllUsers'])->name('admin/users');
});

// Route::group(['prefix'=>'/auditPanel'],function (){
//     Route::get('/',[auditPanel::class,'index'])->name('auditPanel');
//     Route::post('/',[auditPanel::class,'store'])->middleware(['auth', 'verified'])->name('auditPanel');
//     Route::put('/{id}/approve/',[auditPanel::class,'approve'])->name('auditPanel/update');
// });


// Route::post('/admin/login',[AdminSessionController::class,'check'])->name('');

Route::get('/booking',[BookingController::class,'show'])->middleware(['auth', 'verified'])->name('booking');
Route::get('auditoriums',[BookingAuditoriumController::class,'create'])->middleware(['auth', 'verified'])->name('auditoriums');
Route::get('/auditPanel',[auditPanel::class,'index'])->name('auditPanel');
Route::post('/auditPanel',[auditPanel::class,'store'])->middleware(['auth', 'verified'])->name('auditPanel');
Route::put('/auditPanel/{id}/approve/',[auditPanel::class,'approve'])->name('auditPanel/update');
Route::get('/supportPanel',[supportPanelController::class,'index'])->middleware(['auth', 'verified'])->name('supportPanel');
Route::post('/audit-panel/approve-request/{id}', [AuditPanelController::class, 'approveRequest'])->name('audit-panel/approve-request');
Route::post('/audit-panel/deny-message/{id}', [AuditPanelController::class, 'denyMessage'])->name('audit-panel/deny-message');
// function () {
    // return Inertia::render('Booking');
// }
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('users', [UserController::class, 'index'])
//     ->name('users')
//     ->middleware('auth');

require __DIR__.'/auth.php';
