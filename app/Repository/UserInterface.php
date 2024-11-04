<?php

namespace App\Repository;

interface  UserInterface 
{
    public function register($payload);
    public function login($payload);
    public function getUser();
    public function logout();
}