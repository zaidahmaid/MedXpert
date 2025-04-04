<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'specialty',
        'city',
        'consultation_fee',
        'about',
        'education',
        'experience'
        // Add any other fields you need
    ];

    /**
     * Get the user that owns the doctor profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


public function doctorDetail()
{
    return $this->hasOne(DoctorDetail::class);
}
}