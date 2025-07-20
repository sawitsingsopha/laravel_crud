<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLevelController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// ✅ Route สำหรับผู้ใช้ต้อง login และมี permission
Route::middleware(['web', 'auth', 'check.permission'])->group(function () {

    // ✅ Users CRUD + view
    Route::get('/users', [UserController::class, 'index'])->name('users.index');         // list
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); // add
    Route::post('/users', [UserController::class, 'store'])->name('users.store');         // store
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit'); // edit
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update'); // update
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy'); // delete
    Route::get('/users/{user}/show', [UserController::class, 'show'])->name('users.show'); // view

    // ✅ UserLevel CRUD
    Route::resource('userlevel', UserLevelController::class);
    Route::get('userlevel/{id}/permissions', [UserLevelController::class, 'editPermissions'])
        ->name('userlevel.permissions');
    Route::post('userlevel/{id}/permissions', [UserLevelController::class, 'updatePermissions'])
        ->name('userlevel.permissions.update');

    // ✅ Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard.index');

    // ✅ Test Permission
    Route::get('/test-permission', function () {
        return 'Permission OK';
    })->name('users.test');

    // ✅ Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ หน้าแรก (welcome)
Route::get('/', function () {
    return view('welcome');
});

// ✅ auth route ของ Laravel Breeze หรือ Jetstream
require __DIR__.'/auth.php';
