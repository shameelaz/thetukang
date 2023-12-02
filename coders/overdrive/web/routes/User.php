<?php

use Illuminate\Support\Facades\Route;
use Overdrive\Web\Http\Controllers\Backend\DefaultController;
use Overdrive\Web\Http\Controllers\Backend\PermissionController;
use Overdrive\Web\Http\Controllers\Backend\RoleController;
use Overdrive\Web\Http\Controllers\Backend\User\AccountController;
use Overdrive\Web\Http\Controllers\Backend\User\Password\Generate;
use Overdrive\Web\Http\Controllers\Backend\User\Password\PasswordController;
use Overdrive\Web\Http\Controllers\Backend\User\Password\Reset;
use Overdrive\Web\Http\Controllers\Backend\User\UserController;
use Laravolt\Platform\Enums\Permission;

Route::group(
    [
    	// 'namespace'  => '\Overdrive\Web\Http\Controllers\Backend',
        'prefix'     => '',
        'as'         => 'backend::',
        'middleware' => config('laravolt.platform.middleware'),
    ],
    function () {
        // Route::get('/', [DefaultController::class, 'index'])->name('index');

        Route::middleware('can:'.Permission::MANAGE_USER)
            ->group(
                function () {
                    Route::resource('/user/index', UserController::class)->except('show');
                    Route::get('/user/edit/{id}', [AccountController::class, 'edit'])->name('user.edit');
                    Route::post('/user/save', [AccountController::class, 'saveuser'])->name('user.update');
                    Route::get('/user/create/', [UserController::class, 'create'])->name('user.create');
                    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');

                    Route::resource('password', PasswordController::class)->only('edit');
                    Route::post('password/{id}/reset', Reset::class)->name('password.reset');
                    Route::post('password/{id}/generate', Generate::class)->name('password.generate');
                }
            );

        Route::middleware('can:'.Permission::MANAGE_ROLE)->resource('roles', RoleController::class);

        Route::middleware('can:'.Permission::MANAGE_PERMISSION)
            ->group(
                function () {
                    Route::get('/user/permissions', [PermissionController::class, 'index'])->name('permissions.index');
                    Route::get('/user/editpermission/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
                    Route::post('/permissions', [PermissionController::class, 'update'])->name('permissions.update');
                    Route::get('/user/deletepermission/{id}', [PermissionController::class, 'delete'])->name('permission.delete');


                    Route::get('/user/roles', [RoleController::class, 'index'])->name('role.index');
                    Route::get('/user/editrole/{id}', [RoleController::class, 'edit'])->name('role.edit');
                    Route::put('/user/roleupdate/', [RoleController::class, 'update'])->name('role.update');
                    Route::get('/user/addrole', [RoleController::class, 'add'])->name('role.add');
                    Route::post('/user/rolesave',[RoleController::class, 'save'])->name('role.save');
                }
            );
    }
);
