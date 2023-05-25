<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
//use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Mail;
use App\Profile;
use App\ProfileReport;
use PDF;
use Swift_Mailer;
use Swift_Message;
use Swift_Attachment;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();
        return view('reports.index', compact('reports'));
    }

    public function show($id)
    {
        $report = Report::find($id);
       // $report = Report::with('profiles')->findOrFail($id);
     //   dd($report);
        $profiles = Profile::all();
       // $profiles = $report->profiles;
        
        return view('reports.show', compact('report','profiles'));
     
    }

    public function create()
    {
        $profiles = Profile::all();
        return view('reports.create', compact('profiles'));        
    }

    public function store(Request $request)
    {
        /*
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'profile_id.*' => 'exists:profiles,id',
        ]);
        */
        $report = new Report([
            //'report_id' => $request('id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),    
        ]);
        $report->save();
           
        $profileIds = new ProfileReport();
        $profileIds->profile_id = $request->input('profile_id');
        $profileIds->report_id =$report->id;
//     dd($profileIds);
        $profileIds->save();


        // Generate the PDF and get its path
       /*
        $pdfPath = $this->generatePDF($report);

        // Send the email with the PDF attachment
        $email = 'agostneto6@gmail.com'; // Replace with your email address
        Mail::to($email)->send(new ReportCreated($report, $pdfPath));
        */
        return redirect()->route('reports.index');
    }

    public function edit($id)
    {
        $report = Report::find($id);
        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = Report::find($id);
        $report->title = $request->input('title');
        $report->description = $request->input('description');
        $report->save();

        return redirect()->route('reports.index');
    }

    public function destroy($id)
    {
        $report = Report::find($id);
        $report->delete();

        return redirect()->route('reports.index');
    }
    
    public function generatePDF(Report $report)
    {
        $pdf = PDF::loadView('reports.pdf', compact('report'));

        $pdfPath = storage_path('app/public/reports/') . 'report_' . $report->id . '.pdf';
        $pdf->save($pdfPath);

        return $pdfPath;
    }

    public function saveAndSendReport(Request $request)
    {
        // Generate the PDF
        $pdf = PDF::loadView('reports.report', ['data' => $request->data]);
        $pdfContent = $pdf->output();

        // Save the PDF file
        $pdfPath = storage_path('app/reports/report.pdf');
        file_put_contents($pdfPath, $pdfContent);

        // Send the email
        $this->sendEmailWithAttachment($pdfPath);

        return response()->json(['message' => 'Report saved and email sent.']);
    }

    private function sendEmailWithAttachment($filePath)
    {
        $mailer = app()->make(Swift_Mailer::class);

        $message = new Swift_Message();
        $message->setSubject('Report PDF');
        $message->setFrom(['your_email@example.com' => 'Your Name']);
        $message->setTo(['recipient@example.com']);
        $message->setBody('Please find the attached report PDF.');

        $attachment = new Swift_Attachment(file_get_contents($filePath), 'report.pdf', 'application/pdf');
        $message->attach($attachment);

        $mailer->send($message);
    }
}
