<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderedStudentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $reorder_students = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reorder_students = [])
    {
        $this->reorder_students = $reorder_students;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.studentsOrder');
    }
}
