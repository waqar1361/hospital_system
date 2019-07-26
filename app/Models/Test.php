<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Test extends Model
{
	use SoftDeletes;
    protected $primaryKey = 'id';
    protected $fillable = [
    	'name',
	    'cost',
	    'type',
	    'added_by'
    ];
	
	public static function allTests(){
		$tests = self::all();
		return $tests;
	}
	
	public static function paginateTests(){
		$tests = self::paginate(25);
		return $tests;
	}
	
	public static function getTests($id){
		if($id){
			$tests = self::where('id', $id)->first();
			return $tests;
		}
		return null;
	}
	
	public static function addUpdateTests($request, $id=0){
		if($id){
			$tests = self::getTests($id);
		}else{
			$tests = new self;
		}
		$tests->name = $request['name'];
		$tests->cost = $request['cost'];
		$tests->type = $request['type'];
		$tests->added_by = Auth::id();
		$result =$tests->save();
		return $result;
	}
	
	public static function deleteTests($id){
		$result = null;
		if($id){
			$tests = self::getTests($id);
			if($tests){
				$result = $tests->delete();
			}
		}
		return $result;
	}
	
}
