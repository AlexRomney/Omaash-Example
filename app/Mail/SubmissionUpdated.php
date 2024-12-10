<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubmissionUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $submission;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $submission)
    {
        $this->name = $name;
        $this->submission = $submission;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('Emails.submission_updated')
            ->subject('Your submission has been updated!');
    }
}
