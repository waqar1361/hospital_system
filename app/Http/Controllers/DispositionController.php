<?php

namespace App\Http\Controllers;

use App\CommonUtilities;
use App\Disposition;
use Illuminate\Http\Request;

class DispositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
         try {
            $dispositions = Disposition::all();
            return view('dispositions.index')->with(compact('dispositions'));
          } catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }

    public function create()
    {
         try {
             $diagnoses = Disposition::all();
            return view('dispositions.create',compact('diagnoses'));
          } catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }

    public function edit($id)
    {
         try {
            $disposition = Disposition::getDisposition($id);
            return view('dispositions.edit')->with(compact('disposition'));
          } catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }

    public function store(Request $request)
    {
         try {
             $id = $request['diagnosis_id'];
             Disposition::addUpdateDisposition($request, $id);
            return CommonUtilities::resultResponse([
                'redirect' => route('dispositions.index')
            ]);
          }catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }

    public function update(Request $request, $id)
    {
         try {
            $result = Disposition::addUpdateDisposition($request, $id);
             return CommonUtilities::resultResponse([
                 'redirect' => route('dispositions.index')
             ]);
          } catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }

    public function delete($id)
    {
         try {
            $result = Disposition::deleteDisposition($id);
            return CommonUtilities::resultResponse($result);
          } catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }


}
