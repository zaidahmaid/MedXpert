<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Doctor;
use App\Models\admin\Patient;
use App\Models\admin\Appointment;
use App\Models\User;
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
        $doctors = Doctor::with('user')->get();
        $appointments = Appointment::where('user_id', $id)
            ->with('doctor.user')
            ->orderBy('appointment_date', 'desc')
            ->get();
        
        return view('admindashboard.patients.editpatient', compact('patient', 'doctors', 'appointments'));
    }

   
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $request->user_id,
            'role' => 'required|in:admin,doctor,patient',
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
            
            $patient->user->update([
                'name' => $request->name,
                'email' => $request->email,
                'role' => $request->role,
            ]);
            
            $patient->update([
                'age' => $request->age,
                'gender' => $request->gender,
            ]);
            
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
            
            return redirect()->route('pat')
                ->with('success', 'Patient information updated successfully');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->withInput()->with('error', 'Error updating patient information: ' . $e->getMessage());
        }
    }
    
    
    public function destroy($id)
    {
        DB::beginTransaction();
        
        try {
            $patient = Patient::findOrFail($id);
            $userId = $patient->user_id;
            
            $patient->delete();
            
            User::destroy($userId);
            
            DB::commit();
            
            return redirect()->route('pat')
                ->with('success', 'Patient and all associated records have been deleted');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return back()->with('error', 'Error deleting patient: ' . $e->getMessage());
        }
    }
    
   
    public function storeAppointment(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'status' => 'required|in:pending,confirmed,cancelled',
            'notes' => 'nullable|string',
        ]);
    
        try {
            Appointment::create([
                'user_id' => $request->patient_id,  // تأكد أن لديك عمود user_id في جدول appointments
                'doctor_id' => $request->doctor_id,
                'appointment_date' => $request->date,  // تأكد أن الاسم في الفورم هو "date"
                'appointment_time' => $request->time,  // تأكد أن الاسم في الفورم هو "time"
                'status' => $request->status,
                'notes' => $request->notes,
            ]);
    
            return back()->with('success', 'Appointment scheduled successfully');
    
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Error scheduling appointment: ' . $e->getMessage());
        }
    }
    
   
    public function destroyAppointment($id)
    {
        try {
            Appointment::destroy($id);
            return back()->with('success', 'Appointment deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting appointment: ' . $e->getMessage());
        }
    }
}