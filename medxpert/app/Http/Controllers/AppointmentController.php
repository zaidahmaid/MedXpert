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
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);

        // Ensure the appointment is available
        if ($appointment->status !== 'pending') {
            return back()->with('error', 'This appointment is no longer available.');
        }

        // Fetch the available slot
        $slot = $appointment->slot()->first();

        if (!$slot || $slot->is_booked) {
            return back()->with('error', 'This slot is already booked.');
        }

        // Test Patient ID (Replace this with actual patient logic later)
        $testPatientId = 1; // Ensure this ID exists in your `patients` table

        // Update the appointment
        $appointment->update([
            'status' => 'confirmed',
            'user_id' => $testPatientId, // Ensure this column name is correct
        ]);

        // Mark the slot as booked
        $slot->update(['is_booked' => true]);

        // Save the appointment details to medical history
        PatientMedicalHistory::create([
            'patient_id' => $testPatientId,
            'notes' => "Booked appointment on {$appointment->appointment_date} at {$appointment->appointment_time}.",
        ]);

        return back()->with('success', 'Appointment booked successfully!');
    }
}
