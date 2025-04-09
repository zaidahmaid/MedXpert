<?php

namespace App\Http\Controllers;

use App\Models\admin\Doctor;
use Illuminate\Http\Request;
use App\Models\available_slots;
use Illuminate\Support\Facades\DB;
use App\Models\admin\DoctorDetails;
use Illuminate\Support\Facades\Session;



class HomeController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get all doctors with their user information
        $doctors = Doctor::with('user')->get();

        // Get distinct specialties from doctor_details table
        $specialties = DB::table('doctor_details')->select('specialty')->distinct()->get()->pluck('specialty');

        // Get distinct cities from doctor_details table
        $cities = DB::table('doctor_details')->select('city')->distinct()->get()->pluck('city');

        return view('home', compact('doctors', 'specialties', 'cities'));
    }

    /**
     * Search for doctors based on filters.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function search(Request $request)
    {
        $query = Doctor::with(['user', 'doctorDetail']);

        // Apply filters if provided
        if ($request->filled('doctor_id')) {
            $query->where('id', $request->doctor_id);
        }

        if ($request->filled('specialty')) {
            $query->whereHas('doctorDetail', function ($q) use ($request) {
                $q->where('specialty', $request->specialty);
            });
        }

        if ($request->filled('city')) {
            $query->whereHas('doctorDetail', function ($q) use ($request) {
                $q->where('city', $request->city);
            });
        }

        if ($request->filled('min_price')) {
            $query->whereHas('doctorDetail', function ($q) use ($request) {
                $q->where('price', '>=', $request->min_price);
            });
        }

        if ($request->filled('max_price')) {
            $query->whereHas('doctorDetail', function ($q) use ($request) {
                $q->where('price', '<=', $request->max_price);
            });
        }

        $doctors = $query->get();
        $appointments = available_slots::where('is_booked', 0)->get();


        return view('doctor', ['doctors' => $doctors, 'appointments' => $appointments]);
    }
}
