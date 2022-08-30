<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CandidateSearchMail extends Mailable
{
    use Queueable, SerializesModels;

    public $custom_message;
    public $company_name;
    public $candidate_name;

    public function __construct($candidate_name, $custom_message, $company_name)
    {
        $this->candidate_name = $candidate_name;
        $this->company_name = $company_name;
        $this->custom_message = $custom_message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.candidate-search-mail');
    }
}
