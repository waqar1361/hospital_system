<?php

namespace App\Http\Controllers;

use App\CommonUtilities;
use App\Treatment;
use App\Http\Requests\TreatmentRequest;


class TreatmentController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }
    
	public function viewAll() {
		try {
		 
			$treatments = Treatment::allTreatments();
			
			return view( 'treatments.index' )->with( compact( 'treatments' ) );
		} catch ( \Exception $e ) {
			return $e->getMessage();
		}
	}
    
    public function createTreatment() {
        return view('treatments.create');
    }
	public function addTreatment( TreatmentRequest $request ) {
		try {
			$result = Treatment::addUpdateTreatment( $request );
			
			return CommonUtilities::resultResponse( $result );
		} catch ( \Exception $exception ) {
			return $exception->getMessage();
		}
	}
	
	public function updateTreatment( TreatmentRequest $request, $id ) {
		try {
			$result = Treatment::addUpdateTreatment( $request, $id );
			
			return CommonUtilities::resultResponse( $result );
		} catch ( \Exception $exception ) {
			return $exception->getMessage();
		}
	}
	
	public function deleteTreatment( $id ) {
		try {
			$result = Treatment::deleteTreatment( $id );
			
			return CommonUtilities::resultResponse( $result );
		} catch ( \Exception $e ) {
			return $e->getMessage();
		}
	}
	
	public function getTreatment( $id ) {
		try {
			$treatment = Treatment::getTreatment( $id );
			return view('treatments.edit')->with(compact('treatment'));
		} catch ( \Exception $exception ) {
			return $exception->getMessage();
		}
	}
	
	
}
