<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Doctor;
use App\Models\admin\DoctorDetails;
use App\Models\admin\Patient;
use App\Models\admin\Appointment;
use App\Models\available_slots;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Form;
use App\Mail\MessageReply;
use Illuminate\Support\Facades\Mail;


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



    /**
 * Display a listing of all users.
 *
 * @return \Illuminate\Contracts\View\View
 */
public function allUsers()
{
    $users = \App\Models\User::orderBy('created_at', 'desc')->get();
    return view('admindashboard.users.allusers', compact('users'));
}

/**
 * Show form to create a new user
 *
 * @return \Illuminate\Contracts\View\View
 */
public function createUser()
{
    return view('admindashboard.users.create');
}

/**
 * Store a newly created user
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\RedirectResponse
 */
public function storeUser(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        'role' => 'required|in:admin,doctor,patient',
    ]);

    DB::beginTransaction();

    try {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // If user is a patient, create a patient record
        if ($request->role == 'patient') {
            Patient::create([
                'user_id' => $user->id,
                'gender' => $request->gender ?? 'not specified',
                'age' => $request->age ?? 0,
            ]);
        }

        // If user is a doctor, create a doctor record
        if ($request->role == 'doctor') {
            $doctor = Doctor::create([
                'user_id' => $user->id,
            ]);

            // Create doctor details if needed
            DoctorDetails::create([
                'doctor_id' => $doctor->id,
                'specialty' => $request->specialty ?? 'General',
                'clinic_address' => $request->clinic_address ?? '',
                'city' => $request->city ?? 'Amman',
                'phone' => $request->phone ?? '',
                'experience_years' => $request->experience_years ?? 0,
                'rating' => $request->rating ?? 3,
                'price' => $request->price ?? 0,
            ]);
        }

        DB::commit();

        return redirect()->route('users')
            ->with('success', 'User created successfully');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withInput()
            ->with('error', 'Error creating user: ' . $e->getMessage());
    }
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
                'user_id' => $request->patient_id,  
                'doctor_id' => $request->doctor_id,
                'appointment_date' => $request->date,  
                'appointment_time' => $request->time,  
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


    //doc sec
    /**
 * Show the form for editing the specified doctor.
 *
 * @param  int  $id
 * @return \Illuminate\Contracts\View\View
 */
public function editDoctor($id)
{
    $doctor = Doctor::with(['user', 'doctorDetails'])->findOrFail($id);
    $patients = Patient::with('user')->get();
    $avaslot = available_slots::where('doctor_id', $id)
        ->orderBy('date', 'desc')
        ->get();
    
    return view('admindashboard.doctors.editdoctor', compact('doctor', 'patients', 'avaslot'));
}

/**
 * Update the specified doctor in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  int  $id
 * @return \Illuminate\Http\RedirectResponse
 */
public function updateDoctor(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $request->user_id,
        'role' => 'required|in:admin,doctor,patient',
        'specialty' => 'required|string|max:255',
        'clinic_address' => 'required|string',
        'city' => 'required|string|max:100',
        'price' => 'required|numeric|min:0',
        'phone' => 'required|string|max:10',
        'experience_years' => 'required|integer|min:0',
        'rating' => 'required|in:1,2,3,4,5',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    DB::beginTransaction();

    try {
        $doctor = Doctor::findOrFail($id);
        
        $doctor->user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);
        
        // Handle image upload if provided
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/doctors', $imageName);
            
            // Delete old image if exists
            if ($doctor->doctorDetails && $doctor->doctorDetails->image) {
                Storage::delete('public/doctors/' . $doctor->doctorDetails->image);
            }
        } else {
            $imageName = $doctor->doctorDetails->image ?? null;
        }
        
        $doctor->doctorDetails()->updateOrCreate(
            ['doctor_id' => $doctor->id],
            [
                'specialty' => $request->specialty,
                'clinic_address' => $request->clinic_address,
                'city' => $request->city,
                'price' => $request->price,
                'phone' => $request->phone,
                'experience_years' => $request->experience_years,
                'rating' => $request->rating,
                'image' => $imageName,
            ]
        );
        
        DB::commit();
        
        return redirect()->route('doctors')
            ->with('success', 'Doctor information updated successfully');
            
    } catch (\Exception $e) {
        DB::rollBack();
        
        return back()->withInput()->with('error', 'Error updating doctor information: ' . $e->getMessage());
    }
}

/**
 * Remove the specified doctor from storage.
 *
 * @param  int  $id
 * @return \Illuminate\Http\RedirectResponse
 */
public function destroyDoctor($id)
{
    DB::beginTransaction();
    
    try {
        $doctor = Doctor::findOrFail($id);
        $userId = $doctor->user_id;
        
        // Delete doctor image if exists
        if ($doctor->doctorDetails && $doctor->doctorDetails->image) {
            Storage::disk('public')->delete('doctors/' . $doctor->doctorDetails->image);
        }
        
        $doctor->delete();
        
        User::destroy($userId);
        
        DB::commit();
        
        return redirect()->route('doctors')
            ->with('success', 'Doctor and all associated records have been deleted');
            
    } catch (\Exception $e) {
        DB::rollBack();
        
        return back()->with('error', 'Error deleting doctor: ' . $e->getMessage());
    }
}
public function storeSlot(Request $request)
{
    $request->validate([
        'doctor_id' => 'required|exists:doctors,id',
        'date' => 'required|date|after_or_equal:today',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
        'is_booked' => 'required|boolean'
    ]);
    
    available_slots::create([
        'doctor_id' => $request->doctor_id,
        'date' => $request->date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'is_booked' => $request->is_booked
    ]);
    
    return redirect()->back()->with('success', 'New slot added successfully!');
}

public function editSlot(available_slots $slot)
{
    return view('admindashboard.slots.edit', compact('slot'));
}

public function updateSlot(Request $request, available_slots $slot)
{
    $request->validate([
        'date' => 'required|date',
        'start_time' => 'required',
        'end_time' => 'required|after:start_time',
        'is_booked' => 'required|boolean'
    ]);
    
    $slot->update([
        'date' => $request->date,
        'start_time' => $request->start_time,
        'end_time' => $request->end_time,
        'is_booked' => $request->is_booked
    ]);
    
    return redirect()->route('admin.doctors.edit', $slot->doctor_id)->with('success', 'Slot updated successfully!');
}

public function destroySlot(available_slots $slot)
{
    $doctorId = $slot->doctor_id;
    $slot->delete();
    
    return redirect()->route('admin.doctors.edit', $doctorId)->with('success', 'Slot deleted successfully!');
}



public function messages()
{
    // Get all messages with pagination
    $messages = Form::latest()->paginate(10);
    
    return view('admindashboard.mass', compact('messages'));
}

/**
 * Reply to a message
 */
public function replyMessage(Request $request, $id)
{
    $message = Form::findOrFail($id);
    
    // Validate request
    $validated = $request->validate([
        'reply' => 'required|string',
    ]);
    
    // Send email
    Mail::to($message->email)->send(new MessageReply($message, $validated['reply']));
    
    // Mark message as replied in database
    $message->update(['replied' => true]);
    
    return redirect()->route('admin.messages')->with('success', 'Reply sent successfully');
}
public function getUnrepliedMessages()
{
    $unrepliedMessages = Form::where('replied', false)
                            ->latest()
                            ->take(6)
                            ->get();

    $unrepliedCount = Form::where('replied', false)->count();

    return response()->json([
        'messages' => $unrepliedMessages,
        'count' => $unrepliedCount,
    ]);
}
}