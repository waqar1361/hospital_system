<?php

namespace App\Http\Controllers;

use App\PatientVisit;
use Illuminate\Support\Facades\Auth;
use Zend\Diactoros\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('liveChat');
        $this->middleware('admin')->only('billing');
    }

    public function welcome()
    {
        if (Auth::user()->type == 'biller') {
            return redirect()->route('biller.dashboard');
        }

        return view('welcome');
    }

    public function index()
    {
        try {
            $visits = PatientVisit::todayVisits();

            switch (Auth::user()->type) {
                case 'admin':
                    return view('admin.home');
                case 'doctor':
                case 'nurse':
                    return view('doctor.home')->with(compact('visits'));
                case 'biller':
                    return redirect()->route('biller.dashboard');
                default:
                    return back();
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function addNotes()
    {
        return view('admin.addNotes');
    }

    public function billing(Request $request)
    {
        try {

            if (request('from') && request('to')) {
                $visits = PatientVisit::todayBills($request);
            } else {
                $visits = PatientVisit::todayBills();
             }

            return view('admin.billing',compact('visits'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
