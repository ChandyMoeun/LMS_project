<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $employee;
    public $verificationUrl;

    public function __construct($employee, $verificationUrl)
    {
        $this->employee = $employee;
        $this->verificationUrl = $verificationUrl;
    }

    public function build()
    {
        return $this->subject('Password Reset Request')
            ->view('emails.password_reset'); // Ensure you have a view for this email
    }
}
