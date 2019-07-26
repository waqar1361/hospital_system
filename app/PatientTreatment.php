<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientTreatment extends Model
{
    protected $fillable = [
        'visit_id',
        'name',
        'type',
        'cost',
        'quantity'
    ];

    public static function addPatientTreatment($request,  $visit_id)
    {
        $treatment = new self;
        $treatment->name = $request['name'];
        $treatment->type = $request['type'];
        $treatment->cost = $request['cost'];
        $treatment->quantity = $request['quantity'];
        $treatment->visit_id = $visit_id;
        return $treatment->save();
    }

    public static function getByVisit($visit_id)
    {
        return self::where('visit_id', $visit_id)->get();
    }

    public static function deleteOld($id)
    {
        self::where('visit_id',$id)->delete();
    }
}
