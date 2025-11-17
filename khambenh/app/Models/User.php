<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Staff;;
use App\Models\MedicalRecord;
class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }
    public function medicalRecords()
{
    return $this->hasMany(MedicalRecord::class, 'patient_id');
}
   public function appointments()
{
    return $this->hasMany(Appointment::class, 'patient_id');
}
}
