<?php

use Illuminate\Support\Facades\Route;
use App\Models\doctor_details;
use App\Models\Appointment;
use App\Http\Controllers\AppointmentController;
use App\Models\doctors;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AvailableSlot;
use App\Models\admin\Doctor;
use App\Models\admin\Patient;
use App\Models\admin\DoctorDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;



Route::get('/about', function () {
    return view('about'); // تأكد أن اسم الملف هو about.blade.php
});
Route::get('/contact', function () {
    return view('contact'); // تأكد أن اسم الملف هو contact.blade.php
});
Route::post('/contact-submit', function () {
    DB::table('forms')->insert([
        'name' => request('name'), 
        'email' => request('email'), 
        'message' => request('message'), 
        'created_at' => now(), 
        'updated_at' => now(), 
    ]);

    return back()->with('success', 'Your message has been submitted successfully!');
});







Route::get('/', function () {
    return view('admindashboard.index');
});


route::get('/admindashboard', function () {
    $doctorCount = Doctor::count();
    $patientCount = Patient::count();

    $doctorAmman = DoctorDetails::where('city', 'Amman')->count();
    $doctorZarqa = DoctorDetails::where('city', 'Zarqa')->count();
    $doctorIrbid = DoctorDetails::where('city', 'Irbid')->count();

    return view('admindashboard.index', compact('doctorCount', 'patientCount', 'doctorAmman', 'doctorZarqa', 'doctorIrbid'));
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




// zaid's route ========================================================
Route::get('/doctor', [AvailableSlot::class, 'doctors',])->name('doc');
Route::post('/doctor', [AvailableSlot::class, 'book'])->name('doc.book');
// end zaid's route ====================================================