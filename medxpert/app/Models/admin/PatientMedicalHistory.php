<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedicalHistory extends Model
{
    use HasFactory;

    protected $table = 'patient_medical_histories';

    protected $fillable = [
        'patient_id',  
        'chronic_diseases',
        'medications',
        'allergies',
        'notes'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id'); 
    }
}