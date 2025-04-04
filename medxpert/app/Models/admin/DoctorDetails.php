<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'doctor_id',
        'specialty',
        'clinic_address',
        'city',
        'price',
        'phone',
        'experience_years',
        'image',
        'rating',
    ];

    /**
     * Get the doctor that owns these details.
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    // In Doctor model
public function doctorDetails()
{
    return $this->hasOne(DoctorDetails::class);
}

}