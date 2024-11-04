<?php

namespace App\Repository;

use App\Models\User;
use App\Models\Role;
use Hash;
use Log;

class UserRepository  implements UserInterface 
{


    public function register($payload) {
        try {
            $user = User::create([
                'name' => $payload['name'],
                'email' => $payload['email'],
                'password' => Hash::make($payload['password']),
            ]);

            $role = Role::where('name', $payload['role'])->first();
            $user->roles()->attach($role);

            return $user;
            
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
        }
    }
    public function login($payload) {
        
    }
    public function getUser() {}
    public function logout() {}
}