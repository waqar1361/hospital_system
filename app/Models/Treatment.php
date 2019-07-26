<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Treatment extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'id';
    protected $fillable = [
    	'name',
	    'cost',
	    'type',
	    'added_by',
    ];
    
    public static function allTreatments(){
    	$treats = self::all();
    	return $treats;
    }
    
    public static function paginateTreatments(){
    	$treats = self::paginate(25);
    	return $treats;
    }
    
    public static function getTreatment($id){
    	if($id){
    		$treat = self::where('id', $id)->first();
    		return $treat;
	    }
	    return null;
    }
    
    public static function addUpdateTreatment($request, $id=0){
      if($id){
      	$treat = self::getTreatment($id);
      }else{
      	$treat = new self;
      }
	    $treat->name = $request['name'];
			$treat->cost = $request['cost'];
			$treat->type = $request['type'];
			$treat->added_by = Auth::id();
			$result =$treat->save();
      return $result;
    }
    
    public static function deleteTreatment($id){
      $result = null;
    	if($id){
      	$user = self::getTreatment($id);
      	if($user){
      		$result = $user->delete();
	      }
      }
      return $result;
		}
    
}
