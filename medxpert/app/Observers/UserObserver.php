<?php

namespace App\Observers;

use App\Models\admin\User;
use App\Models\admin\Doctor;
use App\Models\admin\Patient;
use App\Models\admin\Admin;
use App\Models\admin\PatientMedicalHistory;

class UserObserver
{
    public function created(User $user): void
    {
        if ($user->role === 'doctor') {
            Doctor::create(['user_id' => $user->id]);
        } elseif ($user->role === 'patient') {
            $patient = Patient::create(['user_id' => $user->id, 'age' => 0, 'gender' => 'other']);
            // Create medical history record for the new patient
            PatientMedicalHistory::create(['patient_id' => $patient->id]);
        } elseif ($user->role === 'admin') {
            Admin::create(['user_id' => $user->id]);
        }
    }

    public function updated(User $user): void
    {
        if ($user->isDirty('role')) {
            // Handle role changes and cleanup
            if ($user->getOriginal('role') === 'doctor') {
                Doctor::where('user_id', $user->id)->delete();
            } elseif ($user->getOriginal('role') === 'patient') {
                // Find patient record to get patient_id before deleting
                $patient = Patient::where('user_id', $user->id)->first();
                if ($patient) {
                    // Delete the medical history first
                    PatientMedicalHistory::where('patient_id', $patient->id)->delete();
                    // Then delete the patient record
                    $patient->delete();
                }
            } elseif ($user->getOriginal('role') === 'admin') {
                Admin::where('user_id', $user->id)->delete();
            }

            // Create new role-specific records
            if ($user->role === 'doctor') {
                Doctor::create(['user_id' => $user->id]);
            } elseif ($user->role === 'patient') {
                $patient = Patient::create(['user_id' => $user->id, 'age' => 0, 'gender' => 'other']);
                // Create new medical history for the new patient
                PatientMedicalHistory::create(['patient_id' => $patient->id]);
            } elseif ($user->role === 'admin') {
                Admin::create(['user_id' => $user->id]);
            }
        }
    }

    public function deleted(User $user): void
    {
        // When deleting a user, make sure to clean up all associated records
        if ($user->role === 'patient') {
            $patient = Patient::where('user_id', $user->id)->first();
            if ($patient) {
                PatientMedicalHistory::where('patient_id', $patient->id)->delete();
            }
        }
        
        Doctor::where('user_id', $user->id)->delete();
        Patient::where('user_id', $user->id)->delete();
        Admin::where('user_id', $user->id)->delete();
    }

    public function restored(User $user): void
    {
        // If you implement soft deletes and restoration, you might want to handle
        // recreation of medical history here as well
    }

    public function forceDeleted(User $user): void
    {
        // Similar to deleted, but for force delete operations
    }
}