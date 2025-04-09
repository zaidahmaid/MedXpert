<?php

namespace App\Http\Controllers;

use App\Models\admin\Appointment;
use App\Models\admin\Doctor;
use App\Models\admin\DoctorDetails;
use Illuminate\Http\Request;
use App\Models\Admin\User;
use App\Models\Admin\Patient;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $patient = $user->patient;
        $appointments = Appointment::where('user_id', $patient->id)
            ->with(['doctor.user'])
            ->get();

        $patientMedicalHistory = $patient->medicalHistory;

        return view('profile.index', compact('user', 'patient', 'appointments', 'patientMedicalHistory'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();


        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'age' => 'required|integer|min:1|max:120',
            'chronic_diseases' => 'required|string|max:255',
            'medications' => 'required|string|max:255',
            'allergies' => 'required|string|max:255',
        ]);

        DB::beginTransaction();

        try {
            $user = User::findOrFail($user->id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            // Calculate age from birth date if provided
            $age = null;
            if ($request->birth_date) {
                $birthDate = new \DateTime($request->birth_date);
                $today = new \DateTime();
                $age = $birthDate->diff($today)->y;
            }

            // Update patient information
            $patient = $user->patient;
            if ($patient) {
                $patient->update([
                    'age' => $age ?? $patient->age,
                    // Gender stays the same as it's not part of the profile update form in your image
                ]);
            }
            $patientMedicalHistory = $patient->medicalHistory;
            if ($patientMedicalHistory) {
                $patientMedicalHistory->update([
                    'chronic_diseases' => $request->chronic_diseases,
                    'medications' => $request->medications,
                    'allergies' => $request->allergies,
                    'notes' => $request->notes,
                ]);
            } else {
                // Create a new medical history record if it doesn't exist
                $patient->medicalHistory()->create([
                    'chronic_diseases' => $request->chronic_diseases,
                    'medications' => $request->medications,
                    'allergies' => $request->allergies,
                    'notes' => $request->notes,
                ]);
            }


            DB::commit();

            return redirect()->route('patientprofile')->with('success', 'Profile updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Failed to update profile: ' . $e->getMessage()]);
        }
    }

    public function showChangePasswordForm()
    {
        return view('profile.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = Auth::user();
        $user = User::findOrFail($user->id);

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect']);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('patientprofile')->with('success', 'Password changed successfully');
    }
}
