<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $email;


    public function __construct($email,$password)
    {
        $this->email = $email;
        $this->password = $password;
    }


    public function build()
    {
        return $this->view('email.user-registered');
    }
}
