<?php

namespace App\Service;

use App\Repository\PatientInterface;

class PatientService 
{
    public  function __construct(
        protected PatientInterface $patientInterface
    ){}
    
    public function all()
    {
        return $this->patientInterface->all();
    }

    public function get($id)
    {
        return $this->patientInterface->get($id);
    }
    
    public function create($data)
    {
        return $this->patientInterface->create($data);
    }

    public function setDoctor($data)
    {
        return $this->patientInterface->setDoctor($data);
    }

    public function removeDoctor($data)
    {
        return $this->patientInterface->removeDoctor($data);
    }

    public function update($data) 
    {
        return $this->patientInterface->update($data);
    }

}