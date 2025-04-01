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


Route::get('/admindashboard/doctors', [DashboardController::class, 'doctors'])->name('doc');
Route::get('/admindashboard/patients', [DashboardController::class, 'patients'])->name('pat');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('patients', DashboardController::class)->except(['create', 'store', 'show', 'destroy']);
});



// zaid's route ========================================================
Route::get('/doctor', [AvailableSlot::class, 'doctors',])->name('doc');
Route::post('/doctor', [AvailableSlot::class, 'book'])->name('doc.book');
// end zaid's route ====================================================



