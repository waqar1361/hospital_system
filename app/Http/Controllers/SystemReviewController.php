<?php

namespace App\Http\Controllers;

use App\CommonUtilities;
use App\SystemReview;
use Illuminate\Http\Request;

class SystemReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index() {
         try {
          $SReviews = SystemReview::all();
          return view('systemReview.index')->with(compact('SReviews'));
          }catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }
    
    public function create() {
        return view('systemReview.create');
    }
    
    public function edit($id) {
        try {
            $SReview = SystemReview::getReview($id);
            return view('systemReview.edit')->with(compact('SReview'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    
    public function store(Request $request) {
         try {
             foreach ($request['review'] as $review)
             {
                 if ($review['name'] != null)
                 {
                     $result = SystemReview::addUpdateReview($review);
                 }
             }
            return CommonUtilities::resultResponse([
                'redirect' => route('systemReviews.index')
            ]);
          }catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }
    
    public function update(Request $request, $id) {
         try {
            $result = SystemReview::addUpdateReview($request,$id);
            return CommonUtilities::resultResponse([
                'redirect' => route('systemReviews.index')
            ]);
          }catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }
    
    public function delete($id) {
         try {
             $result = SystemReview::deleteReview($id);
             return CommonUtilities::resultResponse($result);
          }catch(\Exception $exception) {
             return $exception->getMessage();
         }
    }
    
}
