<?php

namespace App\Jobs;

use App\Mail\OrderedStudentMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $reorder_students = [];
    public $admin_mail = "";

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($admin_mail = "", $reorder_students = [])
    {
        $this->reorder_students = $reorder_students;
        $this->admin_mail = $admin_mail;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->admin_mail)
            ->send(new OrderedStudentMail($this->reorder_students));

    }
}
