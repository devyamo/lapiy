<?php

use App\Http\Controllers\PatientController;
use App\Http\Controllers\Settings\ProfileController; // FIX: Corrected import for ProfileController
use App\Http\Controllers\Auth\AuthenticatedSessionController; // Import for Auth controllers
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
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard/Admin');
        })->name('dashboard');
        
        // Add PHC CRUD routes here (e.g., Route::resource('phcs', PhcController::class); )
    });


    // --- PHC Staff Routes ---
    // Note: Staff are directed to a clean URL /dashboard, but the named route is phcstaff.dashboard
    Route::middleware('role:phc_staff')->group(function () {
        Route::get('/dashboard', function () {
            return Inertia::render('Dashboard/PhcStaff');
        })->name('phcstaff.dashboard');
        
        // Patient routes (Full CRUD - adjusted to fit expected resource route structure)
        Route::get('/patients', [PatientController::class, 'index'])->name('patients.index');
        Route::get('/patients/create', function () {
            return Inertia::render('Patients/Create');
        })->name('patients.create');
        Route::post('/patients', [PatientController::class, 'store'])->name('patients.store');
        Route::get('/patients/{patient}', [PatientController::class, 'show'])->name('patients.show');
        Route::put('/patients/{patient}', [PatientController::class, 'update'])->name('patients.update');
        Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])->name('patients.destroy');
    });
});