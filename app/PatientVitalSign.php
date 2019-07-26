<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientVitalSign extends Model
{
    
    protected $fillable = [
        'visit_id',
        'blood_pressure',
        'pulse',
        'respiration',
        'temperature',
        'height',
        'weight',
        'bmi'
    ];
    
    public static function addUpdateVitalSign($request, $visit_id = null, $id = 0) {
        $result = null;
        if ($id == 0)
        {
            $vitalSign = new self;
        } else
        {
            $vitalSign = self::getVitalSign($id);
        }
        if ($vitalSign)
        {
            if ($visit_id != null)
                $vitalSign->visit_id = $visit_id;
            $vitalSign->blood_pressure = $request['blood_pressure'];
            $vitalSign->pulse = $request['pulse'];
            $vitalSign->respiration = $request['respiration'];
            $vitalSign->temperature = $request['temperature'];
            $vitalSign->height = $request['height'];
            $vitalSign->weight = $request['weight'];
            $vitalSign->bmi = $request['bmi'];
            $result = $vitalSign->save();
        }
        
        return $result;
    }
    
    public static function getVitalSign($id) {
        $vitalSign = self::where('id', $id)->first();
        
        return $vitalSign;
    }
    
    public static function deleteVitalSign($id) {
        $result = null;
        if ($id)
        {
            $vitalSign = self::getVitalSign($id);
            $result = $vitalSign->delete();
        }
        
        return $result;
    }
    
}
