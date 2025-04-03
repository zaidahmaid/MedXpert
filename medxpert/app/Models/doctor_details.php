<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctor_details extends Model
{
    /** @use HasFactory<\Database\Factories\CategoryFactory> */
    use HasFactory;
    protected $table = 'doctor_details';
    protected $fillable = [
        'doctor_id',
        'specialty',
        'clinic_address',
        'city',
        'price',
        'experience_years',
        'image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id', 'name');
    }
    public function doctors()
    {
        return $this->hasOne(doctors::class, 'user_id', 'id');
    }
}
