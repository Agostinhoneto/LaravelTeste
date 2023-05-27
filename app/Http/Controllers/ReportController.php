<?php

namespace App\Http\Controllers;

use App\Model\Report;
use Illuminate\Http\Request;
use App\Model\Profile;
use App\Model\ProfileReport;
use Illuminate\Support\Facades\Mail;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::paginate(10);
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
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        
        $report = new Report();
        $report->title = $validatedData['title'];
        $report->description = $validatedData['description'];
        $report->save();

        $profileIds = new ProfileReport();
        $profileIds->profile_id = $request->input('profile_id');
        $profileIds->report_id = $report->id;
        $profileIds->save();

        $title = $report->title;
        $description = $report->description;

        $pdf = PDF::loadView('reports.pdf', compact('title', 'description'));

        // Send e-mail
        try {
            Mail::send([], [], function ($message) use ($report,$pdf) {
                $message->to('agostneto6@gmail.com')
                    ->subject('Reports and PDF')
                    ->attachData($pdf->output(), 'reports.pdf', ['mime' => 'application/pdf'])
                    ->setBody('Congratulations, the report was successfully saved, the PDF file is attached!');
            });
            session()->flash('success', 'Reports successfully saved!');
        } catch (\Exception $e) {
            return response()->json(['message' => 'There was an error sending the email'], 500);
        }
        return redirect()->route('reports.index');
    }

    public function edit($id)
    {
        $report = Report::find($id);
        return view('reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        
        $report = Report::find($id);
        $report->title = $validatedData['title'];
        $report->description = $validatedData['description'];
        $report->save();
        session()->flash('success', 'Reports Edited successfully!');
        return redirect()->route('reports.index');
    }

    public function destroy($id)
    {
        $report = Report::find($id);
        $report->delete();
        session()->flash('success', 'Reports Deleted Successfully!');
        return redirect()->route('reports.index');
    }
}
