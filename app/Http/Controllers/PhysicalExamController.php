<?php

namespace App\Http\Controllers;

use App\CommonUtilities;
use App\PhysicalExamination;
use Illuminate\Http\Request;

class PhysicalExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

	public function index() {
		try {
			$all_exams = PhysicalExamination::allExams();
			return view('physicalExam.index')->with(compact('all_exams'));
		}catch(\Exception $exception) {
			return $exception->getMessage();
		}
	}
	
	public function create() {
		return view('physicalExam.create');
	}
    
    public function edit($id) {
         try {
             $exam = PhysicalExamination::getExam($id);
             return view('physicalExam.edit')->with(compact('exam'));
          }catch(\Exception $exception) {
             return $exception->getMessage();
         }
	}
	
	public function store(Request $request) {
		try {
			foreach ($request['exams'] as $exam)
			{
				if ($exam['exam_name'] != null)
				{
					$result = PhysicalExamination::add_exam($exam);
				}
			}
			return CommonUtilities::resultResponse([
				'redirect' => route('physicalExams.index')
			]);
		}catch(\Exception $exception) {
			return $exception->getMessage();
		}
	}
    
    public function update(Request $request, $id) {
        try
        {
            $result = PhysicalExamination::update_exam($request, $id);
            
            return CommonUtilities::resultResponse([
                'redirect' => route('physicalExams.index')
            ]);
        } catch (\Exception $exception)
        {
            return $exception->getMessage();
        }
    }
	
	public function delete($id) {
		try {
			$result = PhysicalExamination::delete_exam($id);
			return CommonUtilities::resultResponse($result);
		}catch(\Exception $exception) {
			return $exception->getMessage();
		}
	}
	
}
