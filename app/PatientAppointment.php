<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class PatientAppointment extends Model
{
    use SoftDeletes;

    protected $fillable = [
      'physician_id', 'patient_id', 'appointment_time'
    ];

    public static function getAppointmentsWithPatient($today = false)
    {
        if ($today == false)
        {
            $appointments = self::all();
        }
        else
        {
            $appointments = self::where('appointment_time',date('Y-m-d'))->get();
        }
        $patients = Patient::allPatients('tele_medicine');
        foreach ($appointments as $appointment)
        {
            foreach ($patients as $patient)
            {
                if ($appointment->patient_id == $patient->id)
                    $appointment->patient = $patient;
            }
        }
        return $appointments;
    }

    public static function getByPatientID($patient_id)
    {
        return self::oldest()->where('patient_id',$patient_id)->first();
    }

    public static function addAppointment($request, $patient_id)
    {
        $appointment = new self;
        $appointment->patient_id = $patient_id;
        $appointment->physician_id = Auth::id();
        $appointment->appointment_time = $request['time'];
        return $appointment->save();
    }

}
