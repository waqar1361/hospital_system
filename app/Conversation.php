<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $primaryKey = 'recid';
    protected $fillable = [
        'conversation_id', 'messages' , 'sender_id', 'sender'
    ];

    public static function getPatientChat($patient_id)
    {
        return self::oldest()->where('conversation_id', $patient_id)->get();
    }

    public static function getLatestMessage($conv_id)
    {
        return self::latest()->where('conversation_id', $conv_id)->first();
    }

    public static function addChatMessage($request)
    {
        $chat = new self;
        $chat->conversation_id = $request['patient_id'];
        $chat->messages = $request['messages'];
        $chat->messages = $request['messages'];
        $chat->sender = $request['sender'];
        $chat->sender_id = $request['sender_id'];
        $chat->save();
        return $chat;
    }

    public function getColor()
    {
        $color = null;
        switch ($this->sender)
        {
            case 'doctor':
                $color = 'text-primary';
                break;
            case 'nurse':
                $color = 'text-danger';
                break;
            default :
                $color = 'text-dark';
        }
        return $color;
    }
}
