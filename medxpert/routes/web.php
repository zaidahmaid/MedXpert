<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\doctor_details;
use App\Models\Appointment;
use App\Http\Controllers\AppointmentController;
use App\Models\doctors;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\AvailableSlot;



Route::get('/', function () {
    return view('admindashboard.index', [DashboardController::class, 'doctors']);
});

route::get('/admindashboard', function () {
    return view('admindashboard.index');
})->name('dash');


Route::get('/admindashboard/doctors', [DashboardController::class, 'doctors'])->name('doctor');
Route::get('/admindashboard/patients', [DashboardController::class, 'patients'])->name('pat');



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
