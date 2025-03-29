<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\User;
use App\Models\admin\PatientMedicalHistory;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'age',
        'gender',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function medicalHistory()
    {
        return $this->hasOne(PatientMedicalHistory::class, 'user_id', 'user_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'user_id');
    }
}
