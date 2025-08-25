<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Booking');
});

// If someone hits /dashboard, send them to their role-specific home.
Route::middleware('auth')->get('/dashboard', function () {
    return redirect(RouteServiceProvider::homeByRole());
})->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';



Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/dashboard', function () {
        return view('doctor.dashboard');
    })->name('doctor.dashboard');

    // Add more doctor-only routes here...
});

Route::middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/patient/dashboard', function () {
        return view('patient.dashboard');
    })->name('patient.dashboard');

    // Add more patient-only routes here...
});
