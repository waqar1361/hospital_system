<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class PatientChat extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';

    protected $fillable = [
        'email',
        'token',
    ];

    protected $table = 'patient_chat_verifications';

    public static function verifyToken($email, $patient_token)
    {
        $verify = false;
        $chat_tokens = self::all();
        foreach ($chat_tokens as $token) {
            if ($token->email == $email && $token->token == $patient_token) {
                $verify = true;
                break;
            }
        }
        return $verify;
    }

    public static function createToken($email)
    {
       $token = Str::random(128);
       $chat_token = new self;
       $chat_token->email = $email;
       $chat_token->token = $token;
       $chat_token->save();
       return $chat_token;
    }
    
    public static function expireToken($email)
    {
        $result = self::where('email', $email)->delete();
        return $result;
    }

    public static function expireAllTokens()
    {
        return self::where('created_at', '>=', Carbon::now()->subDay())->delete();
    }

}
