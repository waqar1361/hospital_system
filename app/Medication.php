<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medication extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'name',
        'sig',
        'dispense',
        'refill',
        'type',
        'cost'
    ];
    
    public static function allMedications() {
        return self::all();
    }
    
    public static function addUpdateMedication($request, $id = 0) {
        $result = null;
        if ($id == 0)
        {
            $medication = new self;
        }
        else {
            $medication = self::getMedication($id);
        }
        if ($medication)
        {
            $medication->name = $request['name'];
            $medication->sig = $request['sig'];
            $medication->dispense = $request['dispense'];
            $medication->refill = $request['refill'];
            $medication->type = $request['type'];
            $medication->cost = $request['cost'];
            $result = $medication->save();
        }
        return $result;
        
    }
    
    public static function getMedication($id) {
        return self::where('id',$id)->first();
    }
    
    public static function deleteMedication($id) {
        $medication = self::getMedication($id);
        return $medication->delete();
    }

}
