<?php

use Illuminate\Support\Facades\Route;
use App\Models\doctor_details;
use App\Models\Appointment;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Models\admin\Doctor;
use App\Models\admin\Patient;
use App\Models\admin\DoctorDetails;

Route::get('/about', function () {
    return view('about'); // تأكد أن اسم الملف هو about.blade.php
});
Route::get('/contact', function () {
    return view('contact'); // تأكد أن اسم الملف هو contact.blade.php
});
Route::post('/contact-submit', function () {
    // قم بمعالجة البيانات المُرسلة
    $data = request()->all();

    // عرض رسالة تأكيد
    return back()->with('success', 'Your message has been sent successfully!');
});







Route::get('/', function () {
    return view('admindashboard.index');
});

route::get('/admindashboard',function(){
    $doctorCount = Doctor::count();
    $patientCount = Patient::count();

    $doctorAmman = DoctorDetails::where('city', 'Amman')->count();
    $doctorZarqa = DoctorDetails::where('city', 'Zarqa')->count();
    $doctorIrbid = DoctorDetails::where('city', 'Irbid')->count();

    return view ('admindashboard.index',compact('doctorCount' , 'patientCount' ,'doctorAmman', 'doctorZarqa', 'doctorIrbid'));
})->name('dash');


Route::get('/admindashboard/doctors', [DashboardController::class, 'doctors'])->name('doc');
Route::get('/admindashboard/patients', [DashboardController::class, 'patients'])->name('pat');