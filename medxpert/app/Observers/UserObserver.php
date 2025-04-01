<?php

namespace App\Observers;

use App\Models\admin\User;
use App\Models\admin\Doctor;
use App\Models\admin\Patient;
use App\Models\admin\admin;

class UserObserver
{
    
    public function created(User $user): void
    {
        if ($user->role === 'doctor') {
            Doctor::create(['user_id' => $user->id]);
        } elseif ($user->role === 'patient') {
            Patient::create(['user_id' => $user->id, 'age' => 0, 'gender' => 'other']); 
        } elseif ($user->role === 'admin') {
            Admin::create(['user_id' => $user->id]);
        }
    }

    
    public function updated(User $user): void
    {
        if ($user->isDirty('role')) {

            if ($user->getOriginal('role') === 'doctor') {
                Doctor::where('user_id', $user->id)->delete();
            } elseif ($user->getOriginal('role') === 'patient') {
                Patient::where('user_id', $user->id)->delete();
            } elseif ($user->getOriginal('role') === 'admin') {
                Admin::where('user_id', $user->id)->delete();
            }

            if ($user->role === 'doctor') {
                Doctor::create(['user_id' => $user->id]);
            } elseif ($user->role === 'patient') {
                Patient::create(['user_id' => $user->id, 'age' => 0, 'gender' => 'other']);
            } elseif ($user->role === 'admin') {
                Admin::create(['user_id' => $user->id]);
            }
        }
    }

    
    public function deleted(User $user): void
    {
        Doctor::where('user_id', $user->id)->delete();
        Patient::where('user_id', $user->id)->delete();
        Admin::where('user_id', $user->id)->delete();
    }

    
    public function restored(User $user): void
    {
        
    }

   
    public function forceDeleted(User $user): void
    {
        
    }
}
