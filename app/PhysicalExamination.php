<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PhysicalExamination extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
    	'exam_name',
        'type',
        'description',
        'added_by'
    ];
    
    
    public static function getExam($id){
    	$exam = PhysicalExamination::where('id', $id)->first();
    	return $exam;
    }
    
    public static function allExams(){
    	$exams = self::all();
    	return $exams;
    }
    
    public static function basicExams() {
        return self::where('type','basic')->get();
    }
    
    public static function detailedExams() {
        return self::where('type', 'comprehensive')->get();
    }
    
    public static function add_exam($request){
    	$exam = new self;
    	$exam->exam_name = $request['exam_name'];
    	$exam->type = $request['type'];
    	$exam->description = $request['description'];
    	$exam->added_by = Auth::id();
    	$result = $exam->save();
    	return $result;
    }
    
    public static function update_exam($request, $id) {
        $result = false;
        $exam = self::getExam($id);
        if ($exam)
        {
            $exam->exam_name = $request['exam_name'];
            $exam->type = $request['type'];
            $exam->description = $request['description'];
            $result = $exam->save();
        }
        return $result;
    }
    
    public static function delete_exam($id){
    	$result = null;
    	$exam = self::getExam($id);
    	if($exam){
		    $result = $exam->delete();
	    }
	    return $result;
    }
    
}
