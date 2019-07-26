<?php

namespace App\Http\Controllers;

use App\CommonUtilities;
use App\Mail\ChatVerification;
use App\Models\PatientChat;
use App\Patient;
use App\PatientAppointment;
use App\PatientVisit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PatientAppointmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('patientManage');
    }

    public function index()
    {
         try {
          $appointments = PatientAppointment::getAppointmentsWithPatient();
          return view('appointments.index',compact('appointments'));
          } catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }

    public function today()
    {
         try {
          $appointments = PatientAppointment::getAppointmentsWithPatient('today');
          return view('appointments.today',compact('appointments'));
          } catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }

    public function create($patient_id)
    {
         try {
             $patient = Patient::getPatient($patient_id);
            return view('appointments.create',compact('patient'));
          } catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }

    public function store(Request $request, $patient_id)
    {
         try {
             $result = PatientAppointment::addAppointment($request, $patient_id);
             return CommonUtilities::resultResponse([
                 'redirect' => route('appointments.index')
             ]);
          } catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }

    public function attendPatient($patient_id)
    {
         try {
             $patient = Patient::getPatient($patient_id);
             $visit_details = ['room' => 0, 'type' => 'tele_medicine',];
             $visit = PatientVisit::addUpdateVisit($visit_details, $patient->id);
             $visit->markReady();
             $token = PatientChat::createToken($patient->email);
             $mail = new ChatVerification($patient, $token->token);
             Mail::to($patient->email)->queue($mail);
             return redirect( route('notes.create',$visit->id));
          } catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }

}
