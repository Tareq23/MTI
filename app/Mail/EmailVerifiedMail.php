<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerifiedMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $verifiedToken;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verifiedToken)
    {
        $this->verifiedToken = $verifiedToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Test Mail From Laravel")->view('email.verifiedEmail',['token'=>$this->verifiedToken]);
    }
}
