<?php

namespace App\Http\Controllers;

use App\CommonUtilities;
use App\Mail\ChatVerification;
use App\Models\PatientChat;
use App\Patient;
use App\PatientAppointment;
use App\PatientDisposition;
use App\PatientExam;
use App\PatientHistoryReview;
use App\PatientMedication;
use App\PatientTest;
use App\PatientTreatment;
use App\PatientVisit;
use App\VisitsFee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PatientVisitController extends Controller
{
    public function __construct()
    {
        $this->middleware('patientManage');
    }

    public function allVisits()
    {
        try {
            $visits = PatientVisit::completedVisits();

            return view('visits.allVisits')->with(compact('visits'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function todayVisits()
    {
        try {
            $visits = PatientVisit::todayVisits();
            $today = true;

            return view('visits.allVisits')->with(compact('visits', 'today'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function patientVisits(Patient $patient)
    {
        try {

            $visits = $patient->visits();

            return view('visits.index')->with(compact('visits', 'patient'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function showVisitForm($patient_id)
    {
        try {
            $patient = Patient::getPatient($patient_id);
            $visitsFees = VisitsFee::allFees();

            return view('visits.create')->with(compact('patient', 'visitsFees'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function patientVisitsDetails(PatientVisit $visit)
    {
        try {
            $patient = $visit->patient();
            $note = $visit->note();
            $sign = $visit->vitalSign();
            $history = $patient->history();
            $dispositions = PatientDisposition::getPatientDispositions($visit->id);
            $reviews = PatientHistoryReview::patientHistoryReviews($visit->id);
            $exams = PatientExam::get_visit_reviews($visit->id);
            $tests = PatientTest::getByVisit($visit->id);
            $treatments = PatientTreatment::getByVisit($visit->id);
            $medications = PatientMedication::getByVisit($visit->id);

            return view('visits.show')->with(compact('patient', 'note', 'history', 'visit', 'sign', 'reviews', 'dispositions', 'exams', 'tests', 'treatments', 'medications'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function createVisit(Request $request, $patient_id)
    {
        try {
            $visit = PatientVisit::addUpdateVisit($request, $patient_id);
            $patient = Patient::getPatient($patient_id);
            if ($patient->type == 'tele_medicine') {
                $visit->markReady();
                $token = PatientChat::createToken($patient->email);
                $mail = new ChatVerification($patient, $token->token);
                Mail::to($patient->email)->queue($mail);

                return redirect()->to(route('notes.create', $visit->id));
            }

            return CommonUtilities::resultResponse([
                'redirect' => route('vitalSigns.create', $visit->id),
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function deleteVisit($visit_id)
    {
        try {
            $result = PatientVisit::deleteVisit($visit_id);

            return CommonUtilities::resultResponse($result);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function readytodischarge(PatientVisit $visit)
    {
        try {
            $visit->markReadyToDischaged();
            return CommonUtilities::resultResponse(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function signed(PatientVisit $visit)
    {
        try {
            $visit->markSigned();
            return CommonUtilities::resultResponse(true);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function dischargePatient(PatientVisit $visit)
    {
        try {
            $visit->dischargePatient();
            $patient = $visit->patient();
            if ($patient->type == 'tele_medicine') {
                PatientChat::expireToken($patient->email);
                $appointment = PatientAppointment::getByPatientID($patient->id);
                $appointment->delete();
            }

            return redirect()->route('home');
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function print(PatientVisit $visit)
    {
        try {
            $patient = $visit->patient();
            $note = $visit->note();
            $sign = $visit->vitalSign();
            $history = $patient->history();
            $dispositions = PatientDisposition::getPatientDispositions($visit->id);
            $reviews = PatientHistoryReview::patientHistoryReviews($visit->id);
            $exams = PatientExam::get_visit_reviews($visit->id);
            $tests = PatientTest::getByVisit($visit->id);
            $treatments = PatientTreatment::getByVisit($visit->id);
            $medications = PatientMedication::getByVisit($visit->id);

            if (request('type') == 'doctor') {
                return view('visits.print')->with(compact('patient', 'note', 'history', 'visit', 'sign', 'reviews', 'dispositions', 'exams', 'tests', 'treatments', 'medications'));
            } else {
                return view('visits.patientPrint')->with(compact('patient', 'visit', 'tests', 'treatments', 'medications'));
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
