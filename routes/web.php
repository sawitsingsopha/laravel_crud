<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserLevelController;

// ✅ Example Routes: routes/web.php
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\ProductController;

// Route::middleware(['auth'])->group(function () {
//     Route::get('/users', [UserController::class, 'index'])
//         ->name('users.index')
//         ->middleware('check.permission:users,list');

//     Route::get('/products', [ProductController::class, 'index'])
//         ->name('products.index')
//         ->middleware('check.permission:products,list');
// });


// ✅ Example Routes: routes/web.php

// users
Route::middleware(['web','auth'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])
        ->name('users.index')
        ->middleware('check.permission:users,list');

    Route::get('/users/{user}/show', [UserController::class, 'show'])
        ->name('users.show')
        ->middleware('check.permission:users,list');

    Route::get('/users/create', [UserController::class, 'create'])
        ->name('users.create')
        ->middleware('check.permission:users,add');

    Route::post('/users', [UserController::class, 'store'])
        ->name('users.store')
        ->middleware('check.permission:users,add');

    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('users.edit')
        ->middleware('check.permission:users,edit');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('users.update')
        ->middleware('check.permission:users,edit');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('users.destroy')
        ->middleware('check.permission:users,delete');
});

// userlevel
Route::middleware(['web','auth'])->group(function () {
    Route::resource('userlevel', UserLevelController::class)
        ->middleware('check.permission:userlevel,list');

    Route::get('userlevel/{id}/permissions', [UserLevelController::class, 'editPermissions'])
        ->name('userlevel.permissions')
        ->middleware('check.permission:userlevel,edit');

    Route::post('userlevel/{id}/permissions', [UserLevelController::class, 'updatePermissions'])
        ->name('userlevel.permissions.update')
        ->middleware('check.permission:userlevel,edit');
});


Route::get('/test-permission', function () {
    return 'Permission OK';
})->middleware('check.permission:users,list');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('web','auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
