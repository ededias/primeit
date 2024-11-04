<?php
namespace App\Service;

use App\Repository\UserInterface;

use Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserService 
{
    public function  __construct(
        protected UserInterface $userInterface
    ){}

    
    public function register($payload)
    {
        try {
            $user  = $this->userInterface->register($payload);
            return $this->addRole($user);
        } catch (\Exception $e) {
            Log::error($e->getFile() . ':' . $e->getLine());
            Log::error($e->getMessage());
            return null;
        }
    }
    private function addRole($user) 
    {
        return JWTAuth::claims(['role' => $user->roles()->first()->toArray()['name']])->fromUser($user);
    }
    public function login($payload) 
    {
        try {
            $token = JWTAuth::attempt($payload);
            $user = auth()->user();
            $token = $this->addRole($user);
            return $token;
       } catch (\Exception $e) {
           Log::error($e->getFile() . ':' . $e->getLine());
           Log::error($e->getMessage());
           return null;
       }
    }

}