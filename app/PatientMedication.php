<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientMedication extends Model
{
    protected $fillable = [
      'name', 'type', 'cost', 'quantity', 'dispense', 'refill', 'sig', 'visit_id'
    ];

    public static function addPatientMedication($request, $visit_id)
    {
        $medication = new self;
        $medication->name = $request['name'];
        $medication->type = $request['type'];
        $medication->cost = $request['cost'];
        $medication->quantity = $request['quantity'];
        $medication->dispense = $request['dispense'];
        $medication->sig = $request['sig'];
        $medication->visit_id = $visit_id;
        return $medication->save();
    }

    public static function getByVisit($visit_id)
    {
        return self::where('visit_id', $visit_id)->get();
    }

    public static function deleteOld($id)
    {
        self::where('visit_id', $id)->delete();
    }
}
