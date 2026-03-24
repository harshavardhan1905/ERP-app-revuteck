<?php

use Illuminate\Support\Facades\Route;
// Roles controller
use App\Http\Controllers\RoleController;

//Permission Controller
use App\Http\Controllers\PermissionController;

// Authentication
use App\Http\Controllers\AuthController; // Add this line at the top!

// roles permission
use App\Http\Controllers\RolesPermissionsController;

Route::get('/', function () {
    return view('index'); 
});

// --- 1. Specific Routes (Must come first) ---

// Roles CRUD Route
Route::get('/roles', [RoleController::class, 'index']);
Route::post('/roles', [RoleController::class, 'store']);
Route::put('/roles/{id}', [RoleController::class, 'update']);
Route::delete('/roles/{id}', [RoleController::class, 'destroy']);
Route::get('/roles/trash', [RoleController::class, 'trash']);
Route::post('/roles/{id}/restore', [RoleController::class, 'restore']);
Route::delete('/roles/{id}/force-delete', [RoleController::class, 'forceDelete']);


//Permissions CRUD Route
Route::get('/permissions', [PermissionController::class, 'index']);
Route::post('/permissions', [PermissionController::class, 'store']);
Route::put('/permissions/{id}', [PermissionController::class, 'update']);
Route::delete('/permissions/{id}', [PermissionController::class, 'destroy']);
Route::get('/permissions/trash', [PermissionController::class, 'trash']);
Route::post('/permissions/{id}/restore', [PermissionController::class, 'restore']);
Route::delete('/permissions/{id}/force-delete', [PermissionController::class, 'forceDelete']);

//Roles Permissions CRUD 
Route::get('/roles-permissions', [RolesPermissionsController::class, 'index']);
Route::get('/roles/{id}/permissions', [RolesPermissionsController::class, 'edit']);
Route::post('/roles/{id}/permissions', [RolesPermissionsController::class, 'update']);
Route::post('/roles-permissions/assign', [RolesPermissionsController::class, 'assignPermission']);
Route::post('/permissions/store', [RolesPermissionsController::class, 'storePermission']);


// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// 👇 THIS is the exact route your form is looking for
Route::post('/login', [AuthController::class, 'login'])->name('login.post'); 
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    

// ==========================
// PAGES ROUTING LOGICS 
// ==========================
Route::get('/default', function () {
    return view('public-profile.profiles.default'); 
});

Route::get('/blogger', function (){
    return view('public-profile.profiles.blogger');
});

//Route for Assign permissions 
Route::get('/assign-permissions/{id}', [RolesPermissionsController::class, 'assignPage'])
    ->name('Administration.assign-permissions');

// --- Branded Authentication Routes ---
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/login', function () { return view('authentication.branded.sign-in.index'); })->name('login');
    Route::get('/register', function () { return view('authentication.branded.sign-up.index'); })->name('register');
    Route::get('/forgot-password', function () { return view('authentication.branded.reset-password.enter-email.index'); })->name('forgot-password');
    Route::get('/check-email', function () { return view('authentication.branded.reset-password.check-email.index'); })->name('check-email');
    Route::get('/change-password', function () { return view('authentication.branded.reset-password.change-password.index'); })->name('change-password');
});

// --- 2. Wildcard / Catch-All Routes (Must come last) ---

// Catch-all for public profiles
Route::get('/{page}', function ($page) {
    $viewPath = "public-profile.profiles." . $page;

    if (view()->exists($viewPath)) {
        return view($viewPath);
    }
    
    // IMPORTANT: Don't abort 404 here, or it won't check the next wildcard
    // Fallback to check Administration folder if not found in profiles
    $adminViewPath = "Administration." . $page;
    if(view()->exists($adminViewPath)){
        return view($adminViewPath);
    }

    abort(404);
});