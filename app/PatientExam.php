<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientExam extends Model
{
    protected $fillable = [
        'patient_id',
        'visit_id',
        'exam_name',
        'basic_description',
        'detailed_description',
    ];
    
    public static function get_visit_reviews($visit_id) {
        $visit_exams = self::where('visit_id', $visit_id)->get();
        return $visit_exams;
    }
    
    public static function add_patient_exam($request, $exam_name, $visit_id) {
        $exam = new self;
        $visit = PatientVisit::getVisit($visit_id);
        $patient_id = $visit->patient()->id;
        $exam->patient_id = $patient_id;
        $exam->visit_id = $visit_id;
        $exam->exam_name = $exam_name;
        if (array_key_exists('basic_description', $request))
            $exam->basic_description = $request['basic_description'];
        if (array_key_exists('detailed_description', $request))
            $exam->detailed_description = $request['detailed_description'];
        return $exam->save();
    }
}
