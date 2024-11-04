<?php

namespace App\Http\Controllers;

use App\Service\PatientService;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    //

    public function __construct(
        protected PatientService $service
    ){}

    public function all()
    {
        return $this->service->all();
    }

    public function get($id)
    {
        return response()->json($this->service->get($id));
    }

    public function create(Request $request) 
    {   
        $data = $request->json()->all();
        $data = $this->service->create($data);
        return response()->json($data);
    }

    public function setDoctor(Request $request) 
    {
        $data = $request->json()->all();
        $data = $this->service->setDoctor($data);
        return response()->json($data);
    }

    public function getDoctors()
    {
        $data = $this->service->getDoctors();
        return response()->json($data);
    }

    public function removeDoctor(Request $request) 
    {
        $data = $request->json()->all();
        $data = $this->service->removeDoctor($data);
        return response()->json($data);
    }

    public function update(Request $request) 
    {
        $data = $request->json()->all();
        $data = $this->service->update($data);
        return response()->json($data);
    }

    public function delete($id)
    {
        return response()->json($this->service->delete($id));
    }


}
