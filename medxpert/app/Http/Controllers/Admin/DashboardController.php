<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Doctor;
use App\Models\admin\Patient;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function doctors()
    {
        $doctorCount = Doctor::count();
        $doctors = Doctor::with(['user', 'doctorDetails'])->get();
        return view('admindashboard.doctors.index', compact('doctors'));
    }

    public function patients()
    {
        $patients = Patient::with(['user', 'medicalHistory'])->get();
        return view('admindashboard.patients.index', compact('patients'));
    }




  
    public function edit($id)
    {
        $patient = Patient::with(['user', 'medicalHistory'])->findOrFail($id);
        
        return view('admindashboard.patients.editpatient', compact('patient'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $request->user_id,
            'age' => 'required|integer|min:0|max:120',
            'gender' => 'required|in:male,female,other',
            'chronic_diseases' => 'nullable|string',
            'medications' => 'nullable|string',
            'allergies' => 'nullable|string',
            'notes' => 'nullable|string',
        ]);

    
        DB::beginTransaction();

        try {
            $patient = Patient::findOrFail($id);
            
            // Update user info
            $patient->user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            
            // Update patient info
            $patient->update([
                'age' => $request->age,
                'gender' => $request->gender,
            ]);
            
            // Update or create medical history
            $patient->medicalHistory()->updateOrCreate(
                ['patient_id' => $patient->id],
                [
                    'chronic_diseases' => $request->chronic_diseases,
                    'medications' => $request->medications,
                    'allergies' => $request->allergies,
                    'notes' => $request->notes,
                ]
            );
            
            DB::commit();
            
            return back()->with('success', 'Patient information updated successfully');

                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withInput()->with('error', 'Error updating patient information: ' . $e->getMessage());
        }
    }
}
