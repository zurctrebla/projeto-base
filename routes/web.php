<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ACL\{
    PermissionController,
    PermissionRoleController,
    RoleController
};
use App\Http\Controllers\Admin\{
    DashboardController,
    SettingController,
    UserController
};

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/home', [DashboardController::class, 'index'])->name('admin.index');

    Route::get('/admin/settings', [SettingController::class, 'index']);

    /**
     * Users
     */
    Route::any('/admin/users/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/admin/users/create', [UserController::class, 'create'])->name('users.create');
    Route::put('/admin/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/admin/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');

    /**
     * Permissions
     */
    Route::any('/admin/permissions/search', [PermissionController::class, 'search'])->name('permissions.search');
    Route::get('/admin/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::put('/admin/permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::get('/admin/permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::delete('/admin/permissions/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::get('/admin/permissions/{id}', [PermissionController::class, 'show'])->name('permissions.show');
    Route::post('/admin/permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/admin/permissions', [PermissionController::class, 'index'])->name('permissions.index');

    /**
     * Roles
     */
    Route::any('/admin/roles/search', [RoleController::class, 'search'])->name('roles.search');
    Route::get('/admin/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::put('/admin/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/admin/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::delete('/admin/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::get('/admin/roles/{id}', [RoleController::class, 'show'])->name('roles.show');
    Route::post('/admin/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/admin/roles', [RoleController::class, 'index'])->name('roles.index');

    /**
     * Permission x Role
     */
    Route::get('/admin/roles/{id}/permission/{idPermission}/detach', [PermissionRoleController::class, 'detachPermissionRole'])->name('roles.permission.detach');   /**ok */
    Route::post('/admin/roles/{id}/permissions', [PermissionRoleController::class, 'attachPermissionsRole'])->name('roles.permissions.attach');                      /**ok */
    Route::any('/admin/roles/{id}/permissions/create', [PermissionRoleController::class, 'permissionsAvailable'])->name('roles.permissions.available');             /**ok */

    // Route::put('/admin/roles/{id}/permissions/{id}', [PermissionRoleController::class, 'update'])->name('permissions.update');
    // Route::get('/admin/roles/{id}/permissions/edit/{id}', [PermissionRoleController::class, 'edit'])->name('permissions.edit');
    // Route::delete('/admin/roles/{id}/permissions/{id}', [PermissionRoleController::class, 'destroy'])->name('permissions.destroy');
    // Route::get('/admin/roles/{id}/permissions/{id}', [PermissionRoleController::class, 'show'])->name('permissions.show');
    Route::get('/admin/roles/{id}/permissions', [PermissionRoleController::class, 'permissions'])->name('roles.permissions');
    // Route::get('/admin/roles/{id}/permissions', [PermissionRoleController::class, 'index'])->name('permissions.index');


});

Route::get('test-acl', function () {
    dd(auth()->user()->permissions());
});

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
