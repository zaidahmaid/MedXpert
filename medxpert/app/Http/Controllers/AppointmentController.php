<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\PatientMedicalHistory;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::where('status', 'pending')->get();
        return view('appointments.index', compact('appointments'));
    }

    public function book(Request $request)
    {
        $appointment = Appointment::find($request->appointment_id);

        if (!$appointment || $appointment->status !== 'pending') {
            return back()->with('error', 'This appointment is no longer available.');
        }

        // Use a test patient ID instead of auth()->id()
        $testPatientId = 1; // Replace with an actual patient ID from your database

        // Update appointment status
        $appointment->update([
            'status' => 'confirmed',
            'patient_id' => $testPatientId,
        ]);

        // Move appointment details to PatientMedicalHistory
        PatientMedicalHistory::create([
            'patient_id' => $testPatientId,
            'notes' => 'Booked appointment on ' . $appointment->appointment_date . ' at ' . $appointment->appointment_time,
        ]);

        return back()->with('success', 'Appointment booked successfully!');
    }
}
