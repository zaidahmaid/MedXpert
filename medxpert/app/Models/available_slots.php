<?php

namespace App\Models;

use App\Models\Admin\Doctor;
use Illuminate\Database\Eloquent\Model;

class available_slots extends Model
{
    protected $table = 'available_slots';
    protected $fillable =['doctor_id','date','start_time','end_time','is_booked','updated_at','created_at' ];
    public function doctor()
    {
        return $this->belongsTo(doctor::class, 'doctor_id');
    }
}
