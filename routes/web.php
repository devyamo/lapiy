<?php

use App\Http\Controllers\Admin\PhcController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\Settings\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => true,
        'canRegister' => true,
        'laravelVersion' => \Illuminate\Foundation\Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

// --- Guest Routes ---
Route::middleware('guest')->group(function () {
    // NOTE: The actual POST routes for login/register are handled by Fortify/Breeze setup
    Route::get('login', function () {
        return Inertia::render('Auth/Login');
    })->name('login');
    
    Route::get('register', function () {
        return Inertia::render('Auth/Register');
    })->name('register');
});


// --- Authenticated Routes ---
Route::middleware('auth')->group(function () {
    
    // Main Dashboard Route: Redirects users to their role-specific named dashboard
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }
        
        if ($user->role === 'phc_staff') {
            return redirect()->route('phcstaff.dashboard');
        }
        
        // Fallback for unknown roles (optional)
        return Inertia::render('Dashboard');
    })->name('dashboard');

    
    // --- Profile/Settings Routes (Using the Settings\ProfileController) --- 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Logout
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


    // --- Admin Routes ---
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        
        Route::post('/phcs', [PhcController::class, 'store'])->name('phcs.store');
        Route::delete('/phcs/{phc}', [PhcController::class, 'destroy'])->name('phcs.destroy');
        Route::get('/lgas/{lga}/wards', [PhcController::class, 'getWardsByLga'])->name('lgas.wards');
    });


    // --- PHC Staff Routes ---
    Route::middleware('role:phc_staff')->group(function () {
        Route::get('/phcstaff/dashboard', [DashboardController::class, 'index'])->name('phcstaff.dashboard');
        
        Route::resource('patients', PatientController::class);
        
        Route::get('/api/lgas', [PatientController::class, 'getLgas'])->name('api.lgas');
        Route::get('/api/lgas/{lga}/wards', [PatientController::class, 'getWardsByLga'])->name('api.wards');
    });
});