<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class doctors extends Model
{
    protected $table = 'doctors';
    protected $fillable = [
        'user_id',
        'created_at',
        'updated_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id', 'name');
    }
    public function doctor_details()
    {
        return $this->hasOne(doctor_details::class, 'doctor_id', 'id');
    }
}
