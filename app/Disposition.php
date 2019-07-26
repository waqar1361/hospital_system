<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Disposition extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'disposition', 'diagnosis', 'added_by'
    ];

    public static function getDisposition($id)
    {
        return self::where('id',$id)->first();
    }

    public static function addUpdateDisposition($request, $id = 0)
    {
        $result = false;
        if ($id == 0)
        {
            $disposition = new self;
        }
        else {
            $disposition = self::getDisposition($id);
        }

        if ($disposition)
        {
            if ($request['disposition']) $disposition->disposition = $request['disposition'];
            if ($request['diagnosis'])  $disposition->diagnosis = $request['diagnosis'];
            $disposition->added_by = Auth::id();
            $result = $disposition->save();
        }
        return $result;
    }

    public static function deleteDisposition($id)
    {
        $disposition = self::getDisposition($id);
        return $disposition->delete();
    }

    public function getSpaceLessNameAttribute()
    {
        return preg_replace('/\s+/', '', $this->name);
    }

}
