<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\doctor_details;
// use App\models\AvailableSlot;
use App\Models\Appointment;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AvailableSlot;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorProfileController;
use App\Models\admin\Doctor;
use App\Models\admin\Patient;
use App\Models\admin\DoctorDetails;

Route::get('/doctor', function () {
    $doctors = doctor_details::whereHas('user', function ($query) {
        $query->where('role', 'doctor');
    })->with('user')->get();});

Route::get('/', function () {
    return view('admindashboard.index', [DashboardController::class, 'doctors']);
});

route::get('/admindashboard', function () {
    return view('admindashboard.index');
})->name('dash');


Route::get('/admindashboard/doctors', [DashboardController::class, 'doctors'])->name('doctors');
Route::get('/admindashboard/patients', [DashboardController::class, 'patients'])->name('pat');
Route::get('/admindashboard/users', [DashboardController::class, 'allUsers'])->name('users');

Route::prefix('admin')->name('admin.')->group(function () {
    // User routes
    Route::get('users/create', [DashboardController::class, 'createUser'])->name('users.create');
    Route::post('users', [DashboardController::class, 'storeUser'])->name('users.store');
    
    // Patient routes
    Route::get('patients/{patient}/edit', [DashboardController::class, 'edit'])->name('patients.edit');
    Route::put('patients/{patient}', [DashboardController::class, 'update'])->name('patients.update');
    Route::delete('patients/{patient}', [DashboardController::class, 'destroy'])->name('patients.destroy');
    
    // Doctor routes
    Route::get('doctors/{doctor}/edit', [DashboardController::class, 'editDoctor'])->name('doctors.edit');
    Route::put('doctors/{doctor}', [DashboardController::class, 'updateDoctor'])->name('doctors.update');
    Route::delete('doctors/{doctor}', [DashboardController::class, 'destroyDoctor'])->name('doctors.destroy');
    
    // Appointment routes
    Route::post('appointments', [DashboardController::class, 'storeAppointment'])->name('appointments.store');
    Route::delete('appointments/{appointment}', [DashboardController::class, 'destroyAppointment'])->name('appointments.destroy');
    Route::get('appointments/{appointment}/edit', [DashboardController::class, 'editAppointment'])->name('appointments.edit');
    Route::put('appointments/{appointment}', [DashboardController::class, 'updateAppointment'])->name('appointments.update');

    // Available slots routes
    Route::post('slots', [DashboardController::class, 'storeSlot'])->name('slots.store');
    Route::get('slots/{slot}/edit', [DashboardController::class, 'editSlot'])->name('slots.edit');
    Route::put('slots/{slot}', [DashboardController::class, 'updateSlot'])->name('slots.update');
    Route::delete('slots/{slot}', [DashboardController::class, 'destroySlot'])->name('slots.destroy');
});




Route::get('/clinics', function () {
    // To be implemented
    return view('clinics.index');
})->name('clinics.index');




// Add this route definition
Route::get('/doctors/search', [DoctorProfileController::class, 'search'])->name('doctors.search');
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('doctor/{id}', [DoctorProfileController::class, 'show'])->name('doctor.profile');






// Doctor Profile Routes
Route::get('/doctors/{id}', [DoctorProfileController::class, 'show'])
    ->name('profile');



Route::get('/doctor', [AvailableSlot::class, 'doctors',])->name('doc');
Route::post('/doctor', [AvailableSlot::class, 'book'])->name('doc.book');

Route::get('/auth', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
