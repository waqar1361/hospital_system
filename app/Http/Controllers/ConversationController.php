<?php

namespace App\Http\Controllers;

use App\CommonUtilities;
use App\Conversation;
use App\Models\PatientChat;
use App\Patient;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        try {
            if (request('token')) {
                $email = request('email');
                $token = request('token');
                $verified = PatientChat::verifyToken($email, $token);
                if ($verified == true) {
                    $patient = Patient::getPatientByEmail($email);
                    $messages = Conversation::getPatientChat($patient->id);
                    $count = $messages->count();

                    return view('patients.liveChat', compact('messages', 'patient', 'count'));
                }
            }

            return abort(403);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function store(Request $request)
    {
        try {
            $chat = Conversation::addChatMessage($request);
            $patient = Patient::getPatient($request->patient_id);
            $message = '<div class="card mb-1"><div class="p-2 '.$chat->getColor().'">'.'<b>';
            if ($chat->sender == 'patient') {
                $message .= $patient->fullname;
            } else {
                $message .= $chat->sender;
            }
            $message .= ' : </b>'.$chat->messages.'<span class="pull-right">'.$chat->created_at.'</span>'.'</div></div>';

            return CommonUtilities::resultResponse($message);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function manageChat(Request $request)
    {
        try {
            $patient = Patient::getPatient($request->patient_id);
            $counts = Conversation::getPatientChat($patient->id)->count();
            $current_count = $request->count;
            if ($counts > $current_count) {
                $received = true;
                $latest_message = Conversation::getLatestMessage($request->patient_id);
                $message = '<div class="card mb-1"><div class="p-2 '.$latest_message->getColor().'">'.'<b>';
                if ($latest_message->sender == 'patient') {
                    $message .= $patient->fullname;
                } else {
                    $message .= $latest_message->sender;
                }
                $message .= ' : </b>'.$latest_message->messages.'<span class="pull-right">'.$latest_message->created_at.'</span>'.'</div></div>';
            } else {
                $received = false;
                $message = null;
            }

            return CommonUtilities::resultResponse([
                'received' => $received,
                'message'  => $message,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
