<?php

namespace App\Http\Controllers;

use App\CommonUtilities;
use App\Conversation;
use App\Disposition;
use App\Medication;
use App\PatientDisposition;
use App\PatientExam;
use App\PatientHistory;
use App\PatientHistoryReview;
use App\PatientMedication;
use App\PatientNote;
use App\PatientTest;
use App\PatientTreatment;
use App\PatientVisit;
use App\PhysicalExamination;
use App\SystemReview;
use App\Test;
use App\Treatment;
use Illuminate\Http\Request;

class VisitNoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('patientManage');
    }

    public function showCreateForm($visit_id)
    {
        try {
            $visit = PatientVisit::getVisit($visit_id);
            $patient = $visit->patient();
            $vitalSign = $visit->vitalSign();
            $history = $patient->history();
            $systemReviews = SystemReview::reviews_with_sub_options();
            $basic_exams = PhysicalExamination::basicExams();
            $detailed_exams = PhysicalExamination::detailedExams();
            $medications = Medication::allMedications();
            $dispositions = Disposition::all();
            $treatments = Treatment::all();
            $tests = Test::all();
            $messages = null;
            if ($patient->type == 'tele_medicine') {
                $messages = Conversation::getPatientChat($patient->id);
            }

            return view('notes.create')->with(compact('patient', 'medications', 'visit', 'history', 'vitalSign', 'systemReviews', 'basic_exams', 'detailed_exams', 'dispositions', 'tests', 'treatments', 'messages'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function createNote(Request $request, PatientVisit $visit)
    {
        try {
            $visit->markReadyForCash();
            $patient = $visit->patient();
            $history = $patient->history();
            $bill = $visit->getVisitFee();

            if ($history == null) {
                $history = PatientHistory::addHistory($request, $patient->id);
            } else {
                $history = PatientHistory::updateHistory($request, $history->id);
            }
            $note = PatientNote::addNote($request, $patient->id, $visit->id);
            if (isset($request['diagnoses'])) {
                foreach ($request['diagnoses'] as $diagnosis) {
                    $data = [
                        'diagnosis'   => $diagnosis,
                        'disposition' => $request['dispositions'][$diagnosis],
                    ];
                    PatientDisposition::addPatientDisposition($data, $visit->id);
                }
            }
            if (isset($request['patient_treatments'])) {
                foreach ($request['patient_treatments'] as $treatment) {
                    if (isset($treatment['id'])) {
                        PatientTreatment::addPatientTreatment($treatment, $visit->id);
                        $cost = $treatment['cost'] * $treatment['quantity'];
                        $bill += $cost;
                    }
                }
            }
            if (isset($request['patient_tests'])) {
                foreach ($request['patient_tests'] as $test) {
                    if (isset($test['id'])) {
                        PatientTest::addPatientTest($test, $visit->id);
                        $cost = $test['cost'] * $test['quantity'];
                        $bill += $cost;
                    }
                }
            }
            if (isset($request['patient_medications'])) {
                foreach ($request['patient_medications'] as $medication) {
                    if (isset($medication['id'])) {
                        PatientMedication::addPatientMedication($medication, $visit->id);
                        $cost = $medication['cost'] * $medication['quantity'];
                        $bill += $cost;
                    }
                }
            }
            PatientVisit::addBill($visit->id, $bill);

            return CommonUtilities::resultResponse([
                'note_id' => $note->id,
                'bill'    => $bill,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function editNote(PatientVisit $visit)
    {
        try {
            $patient = $visit->patient();
            $note = $visit->note();
            $vitalSign = $visit->vitalSign();
            $history = $patient->history();
            $systemReviews = SystemReview::reviews_with_sub_options();
            $basic_exams = PhysicalExamination::basicExams();
            $detailed_exams = PhysicalExamination::detailedExams();
            $medications = Medication::allMedications();
            $dispositions = Disposition::all();
            $treatments = Treatment::all();
            $tests = Test::all();

            $patient_dispositions = PatientDisposition::getPatientDispositions($visit->id);
            $patient_reviews = PatientHistoryReview::patientHistoryReviews($visit->id);
            $patient_exams = PatientExam::get_visit_reviews($visit->id);
            $patient_tests = PatientTest::getByVisit($visit->id);
            $patient_treatments = PatientTreatment::getByVisit($visit->id);
            $patient_medications = PatientMedication::getByVisit($visit->id);

            return view('notes.edit')->with(compact('patient', 'note', 'medications', 'visit', 'history', 'vitalSign', 'systemReviews', 'basic_exams', 'detailed_exams', 'dispositions', 'tests', 'treatments', 'patient_dispositions', 'patient_reviews', 'patient_exams', 'patient_tests', 'patient_treatments', 'patient_medications'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function updateNote(Request $request, PatientVisit $visit, $note_id)
    {
        try {
            $visit->markReadyForCash();
            $patient = $visit->patient();
            $history = $patient->history();
            $bill = $visit->getVisitFee();

            if ($history == null) {
                $history = PatientHistory::addHistory($request, $patient->id);
            } else {
                $history = PatientHistory::updateHistory($request, $history->id);
            }
            $note = PatientNote::updateNote($request, $note_id);
            if (isset($request['diagnoses'])) {
            PatientDisposition::deleteOld($visit->id);
                foreach ($request['diagnoses'] as $diagnosis) {
                    $data = [
                        'diagnosis'   => $diagnosis,
                        'disposition' => $request['dispositions'][$diagnosis],
                    ];
                    PatientDisposition::addPatientDisposition($data, $visit->id);
                }
            }

            if (isset($request['patient_treatments'])) {
                PatientTreatment::deleteOld($visit->id);
                foreach ($request['patient_treatments'] as $treatment) {
                    if (isset($treatment['id'])) {
                        PatientTreatment::addPatientTreatment($treatment, $visit->id);
                        $cost = $treatment['cost'] * $treatment['quantity'];
                        $bill += $cost;
                    }
                }
            }
            if (isset($request['patient_tests'])) {
                PatientTest::deleteOld($visit->id);
                foreach ($request['patient_tests'] as $test) {
                    if (isset($test['id'])) {
                        PatientTest::addPatientTest($test, $visit->id);
                        $cost = $test['cost'] * $test['quantity'];
                        $bill += $cost;
                    }
                }
            }
            if (isset($request['patient_medications'])) {
                PatientMedication::deleteOld($visit->id);
                foreach ($request['patient_medications'] as $medication) {
                    if (isset($medication['id'])) {
                        PatientMedication::addPatientMedication($medication, $visit->id);
                        $cost = $medication['cost'] * $medication['quantity'];
                        $bill += $cost;
                    }
                }
            }
            PatientVisit::addBill($visit->id, $bill);

            return CommonUtilities::resultResponse([
                'note_id' => $note->id,
                'bill'    => $bill,
            ]);
        }
        catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
