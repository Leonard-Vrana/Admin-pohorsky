<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

	public string $token;

	public function __construct($token) {
		$this->token = $token;
	}

	public function build() {
		return $this->subject('Obnova hesla ')
			->markdown('components.emails.User.forgotPassword');
	}
}
