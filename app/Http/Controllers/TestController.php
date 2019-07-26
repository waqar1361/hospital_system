<?php

namespace App\Http\Controllers;

use App\CommonUtilities;
use App\Test;
use App\Http\Requests\TestRequest;

class TestController extends Controller
{
    public function __construct() {
        $this->middleware('admin');
    }
    
	public function viewAll() {
		try {
			$tests = Test::allTests();
   
			return view( 'tests.index' )->with( compact( 'tests' ) );
		} catch ( \Exception $e ) {
			return $e->getMessage();
		}
	}
    
    public function createTest() {
        return view('tests.create');
    }
    
	public function addTest( TestRequest $request ) {
		try {
			$result = Test::addUpdateTests( $request );
			
			return CommonUtilities::resultResponse( $result );
		} catch ( \Exception $exception ) {
			return $exception->getMessage();
		}
	}
	
	public function updateTest( TestRequest $request, $id ) {
		try {
			$result = Test::addUpdateTests( $request, $id );
			
			return CommonUtilities::resultResponse( $result );
		} catch ( \Exception $exception ) {
			return $exception->getMessage();
		}
	}
	
	public function deleteTest( $id ) {
		try {
			$result = Test::deleteTests( $id );
			
			return CommonUtilities::resultResponse( $result );
		} catch ( \Exception $e ) {
			return $e->getMessage();
		}
	}
	
	public function getTest( $id ) {
		try {
			$test = Test::getTests( $id );
			return view('tests.edit')->with(compact('test'));
		} catch ( \Exception $exception ) {
			return $exception->getMessage();
		}
	}
	
}
