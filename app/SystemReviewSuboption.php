<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class SystemReviewSuboption extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $fillable = ['name','r_id'];

    public static function getReviewSubOptions_of_sysReview($sr_id)
    {
        return self::where('r_id', $sr_id)->get();
    }

    public static function addUpdateReview($request, $id = 0) {
        $result = null;
        if ($id == 0)
        {

            $review = new self;
            $review->r_id = $request['r_id'];

        } else
        {
            $review = self::getReviewSuboption($id);
        }
        if ($review)
        {
            $review->name = $request['name'];
            $review->r_id = $request['r_id'];

            return $review->save();
        }

        return $result;
    }

    public static function getReviewSuboption($id) {
        return self::where('id', $id)->first();
    }

    public static function deleteReviewSuboption($id) {
        $review = self::getReviewSuboption($id);

        return $review->delete();
    }

}
