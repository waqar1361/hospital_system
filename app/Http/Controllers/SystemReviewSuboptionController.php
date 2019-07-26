<?php

namespace App\Http\Controllers;

use App\SystemReviewSuboption;
use Illuminate\Http\Request;
use DB;

class SystemReviewSuboptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($rid) {
        try {
            $SReviews = DB::table('system_review_suboptions')->where('r_id',$rid)->get();
            $r_id = $rid;
            $rname = DB::table('system_reviews')->where('id',$rid)->value('name');

            return view('systemReviewSubOpt.index')->with(compact('SReviews','r_id','rname'));
        }catch(\Exception $exception) {
            return $exception->getMessage();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($rid)
    {
        $data['r_id'] = $rid;
        return view('systemReviewSubOpt.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            foreach ($request->get('name') as $item) {
                if (true) {
                    DB::table('system_review_suboptions')->insert(['name'=>$item,'r_id'=>$request->get('r_id'),'added_by'=>'1']);
                }
            }
            return redirect('systemReviewsSuboption/'.$request->get('r_id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\SystemReviewSuboption  $systemReviewSuboption
     * @return \Illuminate\Http\Response
     */
    public function show(SystemReviewSuboption $systemReviewSuboption)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SystemReviewSuboption  $systemReviewSuboption
     * @return \Illuminate\Http\Response
     */
    public function edit(SystemReviewSuboption $systemReviewSuboption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SystemReviewSuboption  $systemReviewSuboption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SystemReviewSuboption $systemReviewSuboption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SystemReviewSuboption  $systemReviewSuboption
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('system_review_suboptions')->where('id',$id)->delete();
    }
}
