<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientHistoryReview extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'visit_id',
        'ros',
        'description',
    ];
    
    
    public static function patientHistoryReviews($id)
    {
        $reviews = self::where('visit_id', $id)->get();
        $SReviews = SystemReview::all();
        $patientReviews = [];
        $i = 0;
        foreach ($SReviews as $SReview)
        {
            $j = 0;
            foreach ($reviews as $review)
            {
                if ($review->ros == $SReview->name)
                {
                    $patientReviews[$i]['name'] = $SReview->name;
                    $patientReviews[$i]['reviews'][$j] = $review;
                }
                $j++;
            }
            $i++;
        }
        return $patientReviews;
    }
    
    public static function addUpdateReview($ros, $request, $visit_id = null, $id=0){
        $result = null;
        if($id == 0){
            $review = new self;
        }else{
            $review = self::getReview($id);
        }
        
        if($review){
            if ($visit_id != null) { $review->visit_id = $visit_id; }
            $review->ros = $ros;
            $review->description = $request['state']." ".$request['description'];
            $review->save();
            return $review;
        }
        
        return $result;
    }
    
    public static function getReview($id)
    {
        $review = self::where('id', $id)->first();
        return $review;
    }
    
    public static function deleteReview($id){
        $result = null;
        if($id){
            $review = self::getReview($id);
            $result = $review->delete();
        }
        return $result;
    }
}
