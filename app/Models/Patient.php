<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Patient extends Model
{
    use SoftDeletes;
	protected $primaryKey = 'id';
	protected $fillable = [
		'mrn',
		'first_name',
		'last_name',
		'date_birth',
		'sex',
		'email',
        'type',
		'contact_number',
		'added_by'
	];
	
	protected $dates = ['date_birth'];
    
    public function history() {
        return PatientHistory::where('patient_id', $this->id)->first();
    }
    
    public function visits() {
        $visits = PatientVisit::where('patient_id', $this->id)->where('status','discharged')->get();
        foreach ($visits as $visit)
        {
//            $visit->date = $visit->visit_time->toDateString();
            $visit->time = $visit->visit_time->format('Y-M-d / H:i');
            $visit->physician = $visit->physician()->fullname;
        }
        return $visits;
    }
    
    public function lastVisit() {
        return PatientVisit::latest()->where('patient_id',$this->id)->first();
    }
    
	public static function allPatients($type = 'emr'){
		if ($type == 'emr') {
		    $patients = self::where('type','emr')->get();
		} else {
		    $patients = self::latest()->where('type', 'tele_medicine')->get();
        }
		foreach ($patients as $patient)
        {
            $patient->visit = $patient->lastVisit();
        }
		return $patients;
	}
	
	public static function paginatePatients(){
		$patients = self::paginate(25);
		return $patients;
	}
	
	public static function getPatient($id){
		if($id){
			$patient = self::where('id', $id)->first();
			return $patient;
		}
		return null;
	}

    public static function getPatientByEmail($email)
    {
        return self::where('email', $email)->first();
    }

	public static function addUpdatePatient($request, $id=0){
		if($id){
			$patient = self::getPatient($id);
		}else{
			$patient = new self;
		}
		
		$patient->mrn= $request['mrn'];
		$patient->first_name= $request['first_name'];
		$patient->last_name= $request['last_name'];
		$patient->date_birth= $request['date_birth'];
		$patient->sex= $request['sex'];
		$patient->email= $request['email'];
		if ($request['type'])
		$patient->type= $request['type'];
		$patient->contact_number= $request['contact_number'];
		$patient->added_by= Auth::id();
		$patient->save();
		return $patient;
	}
	
	public static function deletePatient($id){
		$result = null;
		if($id){
			$user = self::getPatient($id);
			if($user){
				$result = $user->delete();
			}
		}
		return $result;
	}
    
    public static function getMRN() {
        return substr(preg_replace(['/\s+/', '/\./'], '', microtime()), 7);
	}
	
    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }
    
}
