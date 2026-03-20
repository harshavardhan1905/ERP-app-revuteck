<?php

use Illuminate\Support\Facades\Route;
// Roles controller
use App\Http\Controllers\RoleController;

//Permission Controller
use App\Http\Controllers\PermissionController;

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
Route::delete('/permissions/{id}', [PermissionController::class, 'destroy']);
Route::get('/permissions/trash', [PermissionController::class, 'trash']);
Route::post('/permissions/{id}/restore', [PermissionController::class, 'restore']);
Route::delete('/permissions/{id}/force-delete', [PermissionController::class, 'forceDelete']);


Route::get('/default', function () {
    return view('public-profile.profiles.default'); 
});

Route::get('/blogger', function (){
    return view('public-profile.profiles.blogger');
});

// --- Branded Authentication Routes ---
Route::prefix('auth')->group(function () {
    Route::get('/login', function () { return view('authentication.branded.sign-in.index'); });
    Route::get('/register', function () { return view('authentication.branded.sign-up.index'); });
    Route::get('/forgot-password', function () { return view('authentication.branded.reset-password.enter-email.index'); });
    Route::get('/check-email', function () { return view('authentication.branded.reset-password.check-email.index'); });
    Route::get('/change-password', function () { return view('authentication.branded.reset-password.change-password.index'); });
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