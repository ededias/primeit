<?php


namespace   App\Repository;

use App\Models\Patient;
use App\Models\User;

class PatientRepository implements PatientInterface
{
   
    public function all($user)
    {
        return Patient::with('users')
        ->whereHas('users', function($query) use($user) {
            if ($user->roles()->get()[0]->name == 'attendant' || $user->roles()->get()[0]->name == 'customer') return $query;
            return $query->where('user_id', $user->id);
        })->get();
    }

    public function get($id) 
    {
        return Patient::find($id)->with('users')->get()[0];
    }

    public function create($payload) 
    {
        $patients =  Patient::create($payload);
        $user = User::find($payload['doctor_id']);
        $user->patients()->attach($patients->id);
        return $patients;
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

    public function getDoctors()
    {
        $doctors = User::select('name', 'id')->whereHas('roles', function ($query) {
            $query->where('name', 'doctor');
        })->get();
        return $doctors;
    }

    public function delete($id)
    {
        return Patient::destroy($id);
    }

}