<?php

namespace App\Mail;

use App\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChatVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $patient;
    public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Patient $patient, $token)
    {
        $this->patient = $patient;
        $this->token = $token;
    }

    public function build()
    {
        return $this->from('noreply@example.com')
            ->subject('Live Chat Invitation Link')
            ->markdown('emails.chatVerification');
    }
}
