<?php

namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientMedicalHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'chronic_diseases',
        'medications',
        'allergies',
        'notes'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'user_id');
    }
}
