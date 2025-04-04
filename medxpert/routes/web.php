<?php

use Illuminate\Support\Facades\Route;
use App\Models\doctor_details;
use App\models\AvailableSlot;
use App\Models\Appointment;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorProfileController;

Route::get('/doctor', function () {
    $doctors = doctor_details::whereHas('user', function ($query) {
        $query->where('role', 'doctor');
    })->with('user')->get();

    $appointments = Appointment::where('status', 'pending')->get();

    return view('doctor', ['doctors' => $doctors, 'appointments' => $appointments]);
});

Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::post('/appointments/book', [AppointmentController::class, 'book'])->name('appointments.book');
// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

// Route::get('/doctors', function () {
//     // To be implemented
//     return view('doctors.index');
// })->name('doctors.index');

// Route::get('/clinics', function () {
//     // To be implemented
//     return view('clinics.index');
// })->name('clinics.index');

// Add more routes as needed








// Route::get('/', function () {
//     return view('admindashboard.index');
// });

// route::get('/admindashboard',function(){
//     return view ('admindashboard.index');
// })->name('dash');


// Route::get('/admindashboard/doctors', [DashboardController::class, 'doctors'])->name('doc');
// Route::get('/admindashboard/patients', [DashboardController::class, 'patients'])->name('pat');
// Route::get('/', function () {
    // return view('home');
// })->name('home');


// Route::get('/doctors', function () {
    // To be implemented
//     return view('doctors.index');
// })->name('doctors.index');




Route::get('/clinics', function () {
    // To be implemented
    return view('clinics.index');
})->name('clinics.index');

// Add more routes as needed
Route::get('/specialties', [SpecialtyController::class, 'index'])->name('specialties.index');
Route::get('/clinics/{clinic}', [ClinicController::class, 'show'])->name('clinics.show');


// Add this route definition
Route::get('/doctors/search', [DoctorProfileController::class, 'search'])->name('doctors.search');
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('doctor/{id}', [DoctorProfileController::class, 'show'])->name('doctor.profile');

// routes/web.php

// Doctor routes
// Route::get('/doctors/{id}', [App\Http\Controllers\DoctorController::class, 'show'])->name('doctors.show');
// Route::get('/doctors/search', [App\Http\Controllers\DoctorController::class, 'search'])->name('doctors.search');

// Appointment routes (to support the "Book Appointment" button)
// Route::get('/appointments/create', [App\Http\Controllers\AppointmentController::class, 'create'])->name('appointments.create');
// In routes/web.php
// Route::get('/doctors/{id}', [App\Http\Controllers\DoctorController::class, 'show'])->name('doctors.show');
// return view('doctors.profile', compact('doctor'));




// Doctor Profile Routes
Route::get('/doctors/{id}', [DoctorProfileController::class, 'show'])
    ->name('profile');

// Appointment Booking Routes (These routes would be implemented in an AppointmentController)
Route::get('/appointments/create/{doctor}', [AppointmentController::class, 'create'])
    ->name('appointments.create');
Route::get('/appointments/book/{slot}', [AppointmentController::class, 'bookSlot'])
    ->name('appointments.book');
