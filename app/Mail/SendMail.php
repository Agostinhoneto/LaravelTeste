<?php

namespace App\Mail;

use App\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
     protected $report;

     public function __construct(Report $report)
     {
         $this->report = $report;
     }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.mail')->with([
            'title'  => $this->report->title,
            'description' => $this->report->description,
        ])->attach(base_path() . '/files/files.pdf');

        return $this->view('reports.index');
    }
}
