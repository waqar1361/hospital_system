<?php

namespace App\Http\Controllers;

use App\CommonUtilities;
use App\PatientExam;
use App\PatientHistoryReview;
use Illuminate\Http\Request;

class PatientDocumentationController extends Controller
{
    public function __construct()
    {
        $this->middleware('patientManage');
    }

    public function storeReviews(Request $request, $visit_id)
    {
        try {

            foreach ($request['reviews'] as $ros => $reviews) {
                foreach ($reviews as $review) {
                    if ($review['description'] != null) {
                        PatientHistoryReview::addUpdateReview($ros, $review, $visit_id);
                    }
                }
            }

            return CommonUtilities::resultResponse("true");
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function storeExams(Request $request, $visit_id)
    {
        try {

            foreach ($request['exams'] as $exam_name => $phy_exam) {
                if ($phy_exam['basic_description'] != null or $phy_exam['detailed_description'] != null) {
                    PatientExam::add_patient_exam($phy_exam, $exam_name, $visit_id);
                }
            }

            return CommonUtilities::resultResponse("true");
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}