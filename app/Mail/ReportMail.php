<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfContent;

    public function __construct($pdfContent)
    {
        $this->pdfContent = $pdfContent;
    }

    public function build()
    {
        return $this->subject('Bem-vindo ao Meu Site')
        ->view('emails.report');

        //return $this->view('emails.report')
          //  ->attachData($this->pdfContent, 'report.pdf', ['mime' => 'application/pdf']);
    }
}
