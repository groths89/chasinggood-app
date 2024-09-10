<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:super-admin|administrator|volunteer']], function () {
    Route::resource('permissions', App\Http\Controllers\PermissionController::class)
        ->middleware(['auth', 'verified']);

    Route::resource('roles', App\Http\Controllers\RoleController::class)
        ->middleware(['auth', 'verified']);

    Route::resource('users', App\Http\Controllers\UserController::class)
        ->middleware(['auth', 'verified']);

    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy'])
        ->middleware(['auth', 'verified'])
        ->name('permissions/{permissionId}/delete');

    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy'])
        ->middleware(['auth', 'verified'])
        ->name('roles/{roleId}/delete');

    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy'])
        ->middleware(['auth', 'verified'])
        ->name('users/{userId}/delete');

    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole'])
        ->middleware(['auth', 'verified'])
        ->name('roles/{roleId}/give-permissions');

    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole'])
        ->middleware(['auth', 'verified'])
        ->name('roles/{roleId}/give-permissions');

    Route::get('users/{userId}/assign-roles', [App\Http\Controllers\UserController::class, 'addRoleToUser'])
        ->middleware(['auth', 'verified'])
        ->name('users/{userId}/assign-roles');

    Route::put('users/{userId}/assign-roles', [App\Http\Controllers\UserController::class, 'assignRoleToUser'])
        ->middleware(['auth', 'verified'])
        ->name('users/{userId}/assign-roles');

    Route::get('nominations', [App\Http\Controllers\NominationsController::class, 'index'])
        ->middleware(['auth', 'verified'])
        ->name('nominations.index');

    Route::get('nominations/{nominationId}/delete', [App\Http\Controllers\NominationsController::class, 'destroy'])
        ->middleware(['auth', 'verified'])
        ->name('nominations/{nominationId}/delete');

    Route::get('nominations/{nominationId}/view', [App\Http\Controllers\NominationsController::class, 'viewEntry'])
        ->middleware(['auth', 'verified'])
        ->name('nominations/{nominationId}/view');

    Route::view('pulse/dashboard', 'vendor.pulse.dashboard')
        ->middleware(['auth', 'verified', 'role:super-admin'])
        ->name('pulse.dashboard');

    Route::view('features/dashboard', 'vendor.pennant.features.dashboard')
        ->middleware(['auth', 'verified', 'role:super-admin'])
        ->name('features.dashboard');
});

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
