<?php

namespace App\Http\Controllers;

use App\CommonUtilities;
use App\Medication;
use App\Patient;
use Illuminate\Http\Request;

class MedicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('index');
    }
    
    public function index() {
         try {
             if (request('medication'))
             {
                 $medication = Medication::getMedication(request('medication'));
                 $patient = Patient::getPatient(request('patient'));
                 return view('notes.print')->with(compact('patient','medication'))->render();
             }
            $medications = Medication::allMedications();
            return view('medication.index')->with(compact('medications'));
          }catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }
    
    public function create() {
        return view('medication.create');
    }
    
    public function edit($id) {
         try {
          $medication = Medication::getMedication($id);
          return view('medication.edit')->with(compact('medication'));
          }catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }
    
    public function store(Request $request) {
         try {
             $result = Medication::addUpdateMedication($request);
             return CommonUtilities::resultResponse($result);
          }catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }
    
    public function update(Request $request, $id) {
         try {
            $result = Medication::addUpdateMedication($request,$id);
            return CommonUtilities::resultResponse($result);
          }catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }
    
    public function delete($id) {
         try {
          $result = Medication::deleteMedication($id);
          return CommonUtilities::resultResponse($result);
          }catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }
    
}
