<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PatientNote extends Model
{
    
    protected $primaryKey = 'id';
    protected $fillable = [
        'patient_id',
        'visit_id',
        'physician_id',
        'chief_complaints',
	      'hpi',
        'assessment',
        'diagnosis',
        'mdm',
        'exam',
        'care_plan',
        'plan',
        'treatment',
        'prescribed_medicine',
        'disposition',
    ];
    
    // A visit has a PatientNote
    public static function getVisit($id)
    {
        $note = self::getNote($id);
        $visit = PatientVisit::getVisit($note->visit_id);
        return $visit;
    }
    
    public static function addNote($request, $patient_id, $visit_id)
    {
        $note = new self;
        $note->patient_id = $patient_id;
        $note->visit_id = $visit_id;
        $note->physician_id = Auth::id();
        $note->chief_complaints = $request['chief_complaints'];
        $note->hpi = $request['hpi'];
        $note->mdm = $request['mdm'];
        $note->care_plan = $request['care_plan'];
        $note->treatment = $request['treatment'];
        $note->prescribed_medicine = $request['prescribed_medicine'];
        $note->save();
        
        return $note;
    }

    public static function updateNote($request, $id)
    {
        $result = null;
        $note = self::getNote($id);
        if ($note)
        {
            $note->chief_complaints = $request['chief_complaints'];
            $note->hpi = $request['hpi'];
            $note->mdm = $request['mdm'];
            $note->care_plan = $request['care_plan'];
            $note->treatment = $request['treatment'];
            $note->prescribed_medicine = $request['prescribed_medicine'];
            $result = $note->save();
        }

        return $result;
    }

    public static function getNote($id)
    {
        $note = self::where('id', $id)->first();
        return $note;
    }
    
    public
    static function deleteNote($id)
    {
        $result = null;
        if ($id)
        {
            $note = self::getNote($id);
            $result = $note->delete();
        }
        
        return $result;
    }

    
}
