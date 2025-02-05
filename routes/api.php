<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;


Route::get('login', [AuthController::class, 'login'])
    ->name('auth.login');
Route::post('reset-password', [AuthController::class, 'resetPassword'])
    ->name('auth.reset-password');

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('/auth')->group(function () {
        Route::post('register', [AuthController::class, 'register'])
            ->name('auth.get');
        Route::post('logout', [AuthController::class, 'logout'])
            ->name('auth.logout');
    });

    Route::prefix('/docs')->group(function () {
        Route::get('', [DocumentController::class, 'index'])
            ->name('docs.index');
        Route::get('get/{id}', [DocumentController::class, 'get'])
            ->name('docs.get');
        Route::post('create', [DocumentController::class, 'create'])
            ->name('docs.create');
        Route::post('edit', [DocumentController::class, 'edit'])
            ->name('docs.edit');
        Route::post('delete', [DocumentController::class, 'delete'])
            ->name('docs.delete');
    });

    Route::prefix('/tags')->group(function () {
        Route::get('', [TagController::class, 'index'])
            ->name('tags.index');
        Route::get('get/{id}', [TagController::class, 'get'])
            ->name('tags.get');
        Route::post('create', [TagController::class, 'create'])
            ->name('tags.create');
        Route::post('edit', [TagController::class, 'edit'])
            ->name('tags.edit');
        Route::post('delete', [TagController::class, 'delete'])
            ->name('tags.delete');
    });

    Route::prefix('/folders')->group(function () {
        Route::get('', [FolderController::class, 'index'])
            ->name('folders.index');
        Route::get('get/{id}', [FolderController::class, 'get'])
            ->name('folders.get');
        Route::post('create', [FolderController::class, 'create'])
            ->name('folders.create');
        Route::post('edit', [FolderController::class, 'edit'])
            ->name('folders.edit');
        Route::post('delete', [FolderController::class, 'delete'])
            ->name('folders.delete');
    });

    Route::prefix('/menus')->group(function () {
        Route::get('', [MenuController::class, 'index'])
            ->name('menus.index');
        Route::get('get/{id}', [MenuController::class, 'get'])
            ->name('menus.get');
        Route::post('create', [MenuController::class, 'create'])
            ->name('menus.create');
        Route::post('edit', [MenuController::class, 'edit'])
            ->name('menus.edit');
        Route::post('delete', [MenuController::class, 'delete'])
            ->name('menus.delete');
    });

});

