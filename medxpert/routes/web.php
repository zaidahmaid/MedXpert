<?php

use Illuminate\Support\Facades\Route;
use App\Models\doctor_details;

// use App\models\AvailableSlot;
// use App\Http\Controllers\AvailableSlot;

use App\Models\Appointment;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DoctorProfileController;
use App\Http\Controllers\AvailableSlot;
use App\Models\admin\Doctor;
use App\Models\admin\Patient;
use App\Models\admin\DoctorDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Form;
use App\Mail\MessageReply;
use Illuminate\Support\Facades\Mail;



Route::get('/about', function () {
    return view('about'); // تأكد أن اسم الملف هو about.blade.php
})->name('about');
Route::get('/contact', function () {
    return view('contact'); // تأكد أن اسم الملف هو contact.blade.php
})->name('contact');
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






// Route::get('/doctor', function () {
//     $doctors = doctor_details::whereHas('user', function ($query) {
//         $query->where('role', 'doctor');
//     })->with('user')->get();

//     $appointments = Appointment::where('status', 'pending')->get();

//     return view('doctor', ['doctors' => $doctors, 'appointments' => $appointments]);
// });

route::get('/admindashboard', function () {
    $doctorCount = Doctor::count();
    $patientCount = Patient::count();

    $doctorAmman = DoctorDetails::where('city', 'Amman')->count();
    $doctorZarqa = DoctorDetails::where('city', 'Zarqa')->count();
    $doctorIrbid = DoctorDetails::where('city', 'Irbid')->count();

    $messageCount = Form::where('replied', false)->count();

    return view('admindashboard.index', compact('doctorCount', 'patientCount', 'doctorAmman', 'doctorZarqa', 'doctorIrbid', 'messageCount'));
})->name('dash');


Route::get('/admindashboard/doctors', [DashboardController::class, 'doctors'])->name('doctors');
Route::get('/admindashboard/patients', [DashboardController::class, 'patients'])->name('pat');
Route::get('/admindashboard/users', [DashboardController::class, 'allUsers'])->name('users');

Route::get('/admindashboard/messages', [DashboardController::class, 'messages'])->name('admin.messages');
Route::post('/admindashboard/messages/{message}/reply', [DashboardController::class, 'replyMessage'])->name('admin.messages.reply');
Route::get('/admin/unreplied-messages', [DashboardController::class, 'getUnrepliedMessages']);

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
// Route::get('/doctors/search', [DoctorProfileController::class, 'search'])->name('doctors.search');
Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('doctor/{id}', [DoctorProfileController::class, 'show'])->name('doctor.profile');






// Doctor Profile Routes
Route::get('/doctors/{id}', [DoctorProfileController::class, 'show'])
    ->name('profile');


// zaid's route ========================================================
Route::get('/doctor', [DoctorProfileController::class, 'search'])->name('doc');
Route::post('/doctor', [AvailableSlot::class, 'book'])->name('doc.book');
// end zaid's route ====================================================




// try to make logn in rejester + patient profile  =============================================================
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

Route::get('/patientprofile', function () {
    return view('profile.index');
})->name('patientprofile');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/patientprofile', [ProfileController::class, 'show'])->name('patientprofile');
    Route::post('/patientprofile', [ProfileController::class, 'update'])->name('patientprofile.update');
    Route::get('/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [ProfileController::class, 'changePassword'])->name('password.update');
});

// Redirect to profile after login
// Route::get('/patientprofile', function () {
//     return redirect()->route('patientprofile');
// })->middleware('auth');

// end try to make lognin rejester + patient profile ==========================================