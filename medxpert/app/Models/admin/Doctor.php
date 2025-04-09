<?php

namespace App\Models\admin;


use App\Models\AvailableSlot;
use App\Models\admin\DoctorDetails;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    /**
     * Get the user that owns the doctor profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the doctor's details.
     */
    public function doctorDetails()
    {
        return $this->hasOne(DoctorDetails::class);
    }

    /**
     * Get the doctor's available slots.
     */
    public function availableSlots()
    {
        return $this->hasMany(AvailableSlot::class);
    }

    /**
     * Get the doctor's appointments.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
