<?php

namespace App\Http\Controllers;

use App\CommonUtilities;
use App\Patient;
use App\Http\Requests\PatientRequest;

class PatientController extends Controller
{
    public function __construct() {
        $this->middleware('patientManage');
    }
    
	public function viewAll() {
		try {
		    $patients = Patient::allPatients();
		    return view( 'patients.index' )->with( compact( 'patients' ) );
		} catch ( \Exception $e ) {
			return $e->getMessage();
		}
	}

    public function tele_medicine()
    {
        try {
            $patients = Patient::allPatients('tele_medicine');
            return view('patients.teleMedicine')->with(compact('patients'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function createPatient() {
       try{
             $mrn = Patient::getMRN();
             return view('patients.create',compact('mrn'));
        }catch(\Exception $exception) {
            return $exception->getMessage();
        }
	}
	
	public function addPatient( PatientRequest $request ) {
		try {
		    $patient = Patient::addUpdatePatient( $request );
		    if ($patient->type == 'tele_medicine')
            {
                return CommonUtilities::resultResponse(['redirect' => route('appointments.create', $patient->id)]);
            }

			return CommonUtilities::resultResponse( ['redirect'=> route('visits.create',$patient->id)] );
		} catch ( \Exception $exception ) {
			return $exception->getMessage();
		}
	}
	
	public function updatePatient( PatientRequest $request, $id ) {
		try {
			$result = Patient::addUpdatePatient( $request, $id );
			
			return CommonUtilities::resultResponse( $result );
		} catch ( \Exception $exception ) {
			return $exception->getMessage();
		}
	}
	
	public function deletePatient( $id ) {
		try {
			$result = Patient::deletePatient( $id );
			
			return CommonUtilities::resultResponse( $result );
		} catch ( \Exception $e ) {
			return $e->getMessage();
		}
	}
	
	public function getPatient( $id ) {
		try {
			$patient = Patient::getPatient( $id );
			return view('patients.edit')->with(compact('patient'));
		} catch ( \Exception $exception ) {
			return $exception->getMessage();
		}
	}
	
}
