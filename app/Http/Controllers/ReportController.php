<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Report;
use Illuminate\Http\Request;
//use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\Mail;
use App\Profile;
use App\ProfileReport;
use Illuminate\Support\Facades\Validator;
use PDF;

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
        $report = Report::with('profiles')->find($id);
        $profile = Profile::first();
        return view('reports.show', compact('report', 'profile'));
    }

    public function create()
    {
        $profiles = Profile::all();
        return view('reports.create', compact('profiles'));
    }

    public function store(Request $request)
    {
        $report = new Report([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        $report->save();
        
        $profileIds = new ProfileReport();
        $profileIds->profile_id = $request->input('profile_id');
        $profileIds->report_id = $report->id;
        $profileIds->save();
        
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

    
    public function generatePDF()
    {
        $report = Report::all();
        $pdf = PDF::loadView('reports.pdf', with('report'));
        return view('reports.pdf', compact('report', 'profile'));
           /*
        $pdfPath = storage_path('app/public/reports/') . 'report_' . $report->id . '.pdf';
        $pdf->save($pdfPath);

        return $pdfPath;
        */    
    }

    /*
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
    */
}
