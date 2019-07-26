<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientTest extends Model
{
    protected $fillable = [
      'visit_id','name', 'type', 'cost', 'quantity'
    ];

    public static function addPatientTest($request, $visit_id)
    {
        $test = new self;
        $test->name = $request['name'];
        $test->type = $request['type'];
        $test->cost = $request['cost'];
        $test->quantity = $request['quantity'];
        $test->visit_id = $visit_id;
        return $test->save();
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
