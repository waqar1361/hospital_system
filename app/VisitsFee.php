<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VisitsFee extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'id';
    protected $fillable = ['type', 'fee'];
    
    public static function allFees() {
        return self::all();
    }
    
    public static function addUpdateFee($request, $id = 0) {
        $result = null;
        if ($id == 0)
        {
            $fee = new self;
        } else
        {
            $fee = self::getFee($id);
        }
        if ($fee)
        {
            $fee->type = $request['type'];
            $fee->fee = $request['fee'];
            
            return $fee->save();
        }
        
        return $result;
    }
    
    public static function getFee($id) {
        return self::where('id',$id)->first();
    }
    
    public static function deleteFee($id) {
        $fee = self::getFee($id);
        return $fee->delete();
    }
}
