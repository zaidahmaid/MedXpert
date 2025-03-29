<?php

use Illuminate\Support\Facades\Route;
use App\Models\doctor_details;
use App\Models\Appointment;
use App\Http\Controllers\AppointmentController;
use App\Models\doctors;

Route::get('/doctor', function () {
    $doctors = doctors::whereHas(
        'user',
        function ($query) {
            $query->where('role', 'doctor');
        }
    )->with(['user', 'doctor_details'])->get();




    $appointments = Appointment::where('status', 'pending')->get();

    return view('doctor', ['doctors' => $doctors, 'appointments' => $appointments]);
});



Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::post('/appointments/book', [AppointmentController::class, 'book'])->name('appointments.book');
