<?php

namespace App\Http\Controllers;

use App\CommonUtilities;
use App\Http\Requests\VitalSignRequest;
use App\PatientNote;
use App\PatientVisit;
use App\PatientVitalSign;
use Illuminate\Http\Request;

class PatientVitalSignController extends Controller
{
    
    public function __construct() {
        $this->middleware('patientManage');
    }
    
    public function showCreateForm($visit_id) {
         try{
             $visit = PatientVisit::getVisit($visit_id);
             return view('vitalSigns.create')->with(compact('visit'));
          }catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }
    
    public function createVitalSign(VitalSignRequest $request, $visit_id){
        try {
            PatientVitalSign::addUpdateVitalSign($request, $visit_id);
            $visit = PatientVisit::getVisit($visit_id);
            $visit->markReady();
            return CommonUtilities::resultResponse([
                'redirect' => route('notes.create',$visit->id)
            ]);
        } catch ( \Exception $exception ) {
            return $exception->getMessage();
        }
    }
    
    public function updateVitalSign(Request $request, $vitalSign_id){
        try{
            $result = PatientVitalSign::addUpdateVitalSign($request,null, $vitalSign_id);
            return CommonUtilities::resultResponse( $result );
        } catch ( \Exception $exception ) {
            return $exception->getMessage();
        }
    }
    
    public function deleteVitalSign($id){
        try{
            $result = PatientVitalSign::deleteVitalSign($id);
            return CommonUtilities::resultResponse( $result );
        } catch ( \Exception $exception ) {
            return $exception->getMessage();
        }
    }
}
