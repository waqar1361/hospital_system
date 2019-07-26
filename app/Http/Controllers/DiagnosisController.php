<?php

namespace App\Http\Controllers;

use App\CommonUtilities;
use App\Disposition;
use Illuminate\Http\Request;

class DiagnosisController extends Controller
{
    
    public function __construct() {
        $this->middleware('admin');
    }
    
    public function index() {
        try {
            $diagnoses = Disposition::all();
            return view('diagnosis.index')->with(compact('diagnoses'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    
    public function create() {
        try {
            return view('diagnosis.create');
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    
    public function store(Request $request) {
        try {
            Disposition::addUpdateDisposition($request);
            return CommonUtilities::resultResponse([
                'redirect' => route('diagnosis.index')
                ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    //
    //public function edit($id) {
    //    try {
    //        $dispositions = Disposition::all();
    //        $diagnosis = Diagnosis::getDiagnosis($id);
    //        return view('diagnosis.edit')->with(compact('diagnosis','dispositions'));
    //    } catch (\Exception $exception) {
    //        return $exception->getMessage();
    //    }
    //}
    //
    //
    //public function update(Request $request, $id) {
    //    try {
    //        $result = Diagnosis::addUpdateDiagnosis($request, $id);
    //        return CommonUtilities::resultResponse([
    //            'redirect' => route('diagnosis.index')
    //        ]);
    //    } catch (\Exception $exception) {
    //        return $exception->getMessage();
    //    }
    //}
    //
    //public function destroy($id) {
    //    try {
    //        $result = Diagnosis::deleteDiagnosis($id);
    //        return CommonUtilities::resultResponse($result);
    //    } catch (\Exception $exception) {
    //        return $exception->getMessage();
    //    }
    //}
}
