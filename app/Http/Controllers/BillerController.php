<?php

namespace App\Http\Controllers;

use App\PatientVisit;
use Illuminate\Http\Request;

class BillerController extends Controller
{
    /**
     * BillerController constructor.
     */
    public function __construct()
    {
        $this->middleware('biller');
    }

    public function home()
    {
         try {
             $visits = PatientVisit::todayVisitsReadyForBill();

          return view('biller',compact('visits'));
          } catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }

    public function payed($visit_id)
    {
         try {
             $visit = PatientVisit::getVisit($visit_id);
             $visit->markBillPayed();
            return back();
          } catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }

}
