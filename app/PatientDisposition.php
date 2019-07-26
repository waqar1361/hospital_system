<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientDisposition extends Model
{
    protected $fillable = [
        'disposition', 'diagnosis', 'visit_id'
    ];

    public static function addPatientDisposition($data, $visit_id)
    {
        $patientDisposition = new self;
        $patientDisposition->disposition = $data['disposition'];
        $patientDisposition->diagnosis = $data['diagnosis'];
        $patientDisposition->visit_id = $visit_id;
        $patientDisposition->save();
    }

    public static function getPatientDispositions($visit_id)
    {
        return self::where('visit_id', $visit_id)->get();
    }

    public static function deleteOld($id)
    {
        self::where('visit_id', $id)->delete();
    }
}
