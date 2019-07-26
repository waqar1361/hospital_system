<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientHistory extends Model
{
    
    protected $primaryKey = 'id';
    protected $fillable = [
        'patient_id',
        'medical',
        'social',
        'surgical',
        'immunization',
        'family',
        'medication',
        'allergies'
    ];
    
    // A Patient has a medical history;
    public static function historyPatientRelation($patient_id)
    {
        $history = self::where('patient_id', $patient_id)->first();
        if ($history == null)
            $history = new self;
        
        return $history;
    }
    
    public static function allHistories()
    {
        $histories = self::all();
        return $histories;
    }
    
    public static function addHistory($request, $patient_id)
    {
        $history = new self;
        
        $history->patient_id = $patient_id;
        $history->medical = $request['medical'];
        $history->social = $request['social'];
        $history->immunization = $request['immunization'];
        $history->family = $request['family'];
        $history->medication = $request['medication'];
        $history->allergies = $request['allergies'];
        $history->save();
        return $history;
    }
    
    public static function updateHistory($request, $id)
    {
        $history = self::getHistory($id);
      
            $history->medical = $request['medical'];
            $history->social = $request['social'];
            $history->immunization = $request['immunization'];
            $history->family = $request['family'];
            $history->medication = $request['medication'];
            $history->allergies = $request['allergies'];
            $history->save();
            return $history;
    }
    
    
    public static function getHistory($id)
    {
        $history = self::where('id', $id)->first();
        return $history;
    }
    
    public static function deleteHistory($id)
    {
        $result = null;
        if ($id)
        {
            $history = self::getHistory($id);
            $result = $history->delete();
        }
        return $result;
    }
    
    
}
