<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemReview extends Model
{
    
    use SoftDeletes;
    
    protected $primaryKey = 'id';
    protected $fillable = ['name'];

    public static function reviews_with_sub_options()
    {
        $sysReviews = self::all();
        foreach ($sysReviews as $sysReview)
        {
            $sysReview->SubOptions = SystemReviewSuboption::getReviewSubOptions_of_sysReview($sysReview->id);
        }

        return $sysReviews;
    }

    public static function addUpdateReview($request, $id = 0) {
        $result = null;
        if ($id == 0)
        {
            $review = new self;
        } else
        {
            $review = self::getReview($id);
        }
        if ($review)
        {
            $review->name = $request['name'];
            
            return $review->save();
        }
        
        return $result;
    }
    
    public static function getReview($id) {
        return self::where('id', $id)->first();
    }
    
    public static function deleteReview($id) {
        $review = self::getReview($id);
        
        return $review->delete();
    }
}
