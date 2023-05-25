<?php

namespace App\Mail;

use App\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


class ReportCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $report;
    public $pdfPath;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Report $report, $pdfPath)
    {
        $this->report = $report;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.report-created')
            ->attach($this->pdfPath, ['as' => 'report.pdf']);
    }
}

