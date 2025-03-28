<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedicalHistory extends Model
{
    use HasFactory;
    protected $table = 'patient_medical_history';
    protected $fillable = ['user_id', 'chronic_diseases', 'medications', 'allergies', 'notes'];

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
