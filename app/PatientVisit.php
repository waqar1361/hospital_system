<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PatientVisit extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'patient_id',
        'visit_time',
        'signed',
        'room',
        'type',
        'bill',
        'physician_id',
        'added_by',
    ];

    protected $dates = ['visit_time'];

    //Following two functions deal with one patients visits;
    public static function visitPatientRelation($patient_id)
    {
        $patient = Patient::getPatient($patient_id);
        $visits = self::paginateVisits();
        foreach ($visits as $visit) {
            if ($visit->patient_id == $patient_id) {
                $visit->patient_details = $patient;
            }
        }
        $results = compact('visits', 'patient');

        return $results;
    }

    //This function deals with just one patient and all the doctors. One to Many relation between physican and patient
    public static function visitPatientPhysician($patient_id)
    {
        $patient_visits = self::visitPatientRelation($patient_id);
        $physicians = User::allUsers();
        foreach ($physicians as $physician) {
            if ($physician->id == $patient_visits->physician_id) {
                $patient_visits->physician_name = $physician->first_name.' '.$physician->last_name;
            }
        }

        return $patient_visits;
    }

    public static function visitPhysicianName($physician_id)
    {
        $physician = User::getUser($physician_id);
        $visits = self::allPatientVisits();
        foreach ($visits as $visit) {
            if ($visit->physician_id == $physician_id) {
                $visit->physician_name = $physician->first_name.' '.$physician->last_name;
            }
        }

        return $physician;
    }

    //  My suggestion for this kind of relation
    //  because i dont get how to use above relations
    public function patient()
    {
        return Patient::getPatient($this->patient_id);
    }

    public function physician()
    {
        return User::getUser($this->physician_id)->first();
    }

    public function note()
    {
        return PatientNote::where('visit_id', $this->id)->first();
    }

    public function getVisitFee()
    {
        $visitFee = VisitsFee::where('type', $this->type)->first();
        if ($visitFee) {
            return $visitFee->fee;
        }

        return 0;
    }

    public function vitalSign()
    {
        return PatientVitalSign::where('visit_id', $this->id)->first();
    }

    public static function allVisits()
    {
        $visits = self::where('type', '!=', 'tele_medicine')->get();

        return $visits;
    }

    public static function todayBills($timeRange = null)
    {
        if ($timeRange == null) {
            return self::where('created_at', '>=', Carbon::now()->subDay())->get();
        }
        $startDate = Carbon::parse($timeRange['from']);
        $endDate = Carbon::parse($timeRange['to']);

        return self::whereBetween('created_at', [$startDate, $endDate])->get();
    }

    public static function todayVisits()
    {
        $visits = self::latest()->where('visit_time', '>=', Carbon::now()->subDay())->where('type', '!=', 'tele_medicine')->get();
        foreach ($visits as $visit) {
            $visit->patient = $visit->patient();
            $visit->time = $visit->visit_time->format('Y-M-d / H:i');
        }

        return $visits;
    }

    public static function todayVisitsReadyForBill()
    {
        $visits = self::latest()->where('visit_time', '>=', Carbon::now()->subDay())->where('status', 'ready_to_discharge')->where('type', '!=', 'tele_medicine')->get();

        foreach ($visits as $visit) {
            $visit->patient = $visit->patient();
        }

        return $visits;
    }

    public static function addUpdateVisit($request, $patient_id, $id = 0)
    {
        $result = null;
        if ($id == 0) {
            $visit = new self;
        } else {
            $visit = self::getVisit($id);
        }
        if ($visit) {
            $visit->patient_id = $patient_id;
            $visit->visit_time = Carbon::now();
            $visit->room = $request['room'];
            $visit->type = $request['type'];
            $visit->physician_id = Auth::id();
            $visit->added_by = Auth::id();
            $visit->save();

            return $visit;
        }

        return $result;
    }

    public static function getVisit($id)
    {
        $visit = self::where('id', $id)->first();

        return $visit;
    }

    public static function deleteVisit($id)
    {
        $result = null;
        if ($id) {
            $visit = self::getVisit($id);
            $result = $visit->delete();
        }

        return $result;
    }

    public static function completedVisits()
    {
        $visits = self::where('status', 'discharged')->where('type', '!=', 'tele_medicine')->get();
        foreach ($visits as $visit) {
            $visit->physician = $visit->physician()->fullname;
            $visit->patient = $visit->patient();
            $visit->time = $visit->visit_time->format('Y-M-d / H:i');
        }

        return $visits;
    }

    public static function addBill($id, $bill)
    {
        $visit = self::getVisit($id);
        $visit->bill = $bill;

        return $visit->save();
    }

    public static function paginateVisits()
    {
        $visits = self::paginate(25);

        return $visits;
    }

    public function markReady()
    {
        $this->status = "ready";

        return $this->save();
    }

    public function markReadyForCash()
    {
        $this->status = "ready_to_discharge";

        return $this->save();
    }

    public function dischargePatient()
    {
        $this->status = "discharged";
        $this->updated_at = now();

        return $this->save();
    }

    public function markSigned()
    {
        $this->signed = true;

        return $this->save();
    }

    public function markReadyToDischaged()
    {
        $this->status = "ready_to_discharge";
        $this->updated_at = now();

        return $this->save();
    }

    public function markBillPayed()
    {
        $this->status = "bill_payed";
        $this->updated_at = now();

        return $this->save();
    }
}
