<?php


namespace   App\Repository;

use App\Models\Patient;
use App\Models\User;

class PatientRepository implements PatientInterface
{
   
    public function all()
    {
        return Patient::with('users')->get();
    }

    public function get($id) 
    {
        return Patient::find($id)->with('users')->get();
    }

    public function create($payload) 
    {
        return Patient::create($payload);
    }

    public function setDoctor($data) 
    {
        $user = User::find($data['doctor_id']);
        $user->patients()->attach($data['patient_id']);
        return $user->with('patients')->get();
    }

    public function removeDoctor($data) 
    {
        $user = User::find($data['doctor_id']);
        // Remove a associação entre o usuário e o paciente
        return $user->patients()->detach($data['patient_id']);
    }

    public function update($data) 
    {
        $user = User::find($data['doctor_id']);
        // Remove a associação entre o usuário e o paciente
        $patient = Patient::find($data['id']);
        $patient->update($data);
        $user->patients()->detach($data['id']);
        return $patient->with('users')->get();
    }

}