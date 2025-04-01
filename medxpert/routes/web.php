<?php

use Illuminate\Support\Facades\Route;
use App\Models\doctor_details;
use App\Models\Appointment;
use App\Http\Controllers\AppointmentController;
use App\Models\doctors;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\zaid;


Route::get('/', function () {
    return view('admindashboard.index');
});

route::get('/admindashboard', function () {
    return view('admindashboard.index');
})->name('dash');


Route::get('/admindashboard/doctors', [DashboardController::class, 'doctors'])->name('doc');
Route::get('/admindashboard/patients', [DashboardController::class, 'patients'])->name('pat');



Route::get('/doctor', [zaid::class, 'doctors',])->name('doc');
Route::post('/doctor', [zaid::class, 'book'])->name('doc.book');