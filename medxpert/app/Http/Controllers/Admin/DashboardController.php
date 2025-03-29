<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Doctor;
use App\Models\admin\Patient;

class DashboardController extends Controller
{
    public function doctors()
    {
        $doctors = Doctor::with(['user', 'doctorDetails'])->get();
        return view('admindashboard.doctors.index', compact('doctors'));
    }

    public function patients()
    {
        $patients = Patient::with(['user', 'medicalHistory'])->get();
        return view('admindashboard.patients.index', compact('patients'));
    }
}
