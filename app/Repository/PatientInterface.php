<?php

namespace App\Repository;

interface PatientInterface 
{
    public function all($user);

    public function get($id);
    
    public function create($payload);

    public function setDoctor($data);

    public function removeDoctor($data);

    public function update($data);

    public function getDoctors();

    public function delete($id);
}