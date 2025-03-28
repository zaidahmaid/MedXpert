<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'doctor_id', 'slot_id', 'appointment_date', 'appointment_time', 'status'];

    public function patient()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
