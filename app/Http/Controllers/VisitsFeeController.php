<?php

namespace App\Http\Controllers;

use App\CommonUtilities;
use App\VisitsFee;
use Illuminate\Http\Request;

class VisitsFeeController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }
    
    public function viewAll() {
        try
        {
            $fees = VisitsFee::allFees();
            return view('fee.index')->with(compact('fees'));
        } catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }
    
    public function createFee() {
        return view('fee.create');
    }
    
    public function addFee(Request $request) {
        try
        {
            $result = VisitsFee::addUpdateFee($request);
            
            return CommonUtilities::resultResponse($result);
        } catch (\Exception $exception)
        {
            return $exception->getMessage();
        }
    }
    
    public function editFee($id) {
         try {
            $fee = VisitsFee::getFee($id);
            return view('fee.edit')->with(compact('fee'));
          }catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }
    
    public function updateFee(Request $request, $id) {
        try
        {
            $result = VisitsFee::addUpdateFee($request,$id);
            
            return CommonUtilities::resultResponse($result);
        } catch (\Exception $exception)
        {
            return $exception->getMessage();
        }
    }
    
    public function deleteFee($id) {
        try
        {
            $result = VisitsFee::deleteFee($id);
            
            return CommonUtilities::resultResponse($result);
        } catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }
    
}
