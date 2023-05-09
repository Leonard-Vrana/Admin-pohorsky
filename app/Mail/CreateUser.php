<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CreateUser extends Mailable
{
    use Queueable, SerializesModels;

	public string $user;
	public string $password;

	public function __construct($user, $password) {
		$this->user = $user;
		$this->password = $password;
	}

	public function build() {
		return $this->subject('Přihlasovací údaje')
			->markdown('components.Emails.User.login-data');
	}
}
