<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\API\ResponseController as ResponseController;
use App\Models\ProfileReport;
use App\Model\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;
use Validator;

class ReportController extends ResponseController
{
    public function index()
    {
        $reports = Report::all();
        return response()->json($reports, 201);
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

        $data = ['titulo' => 'Reports Profile'];
        $pdf = PDF::loadView('reports.pdf', $data, compact('report'));
        // Envio do e-mail
        try {
            Mail::send([], [], function ($message) use ($report,$pdf) {
                $message->to('agostneto6@gmail.com')
                    ->subject('Reports and PDF')
                    ->attachData($pdf->output(), 'reports.pdf', ['mime' => 'application/pdf'])
                    ->setBody(' Reports Saved Successfully attached.
                                Follow PDF in Attachment'
                      );
            });
            session()->flash('success', 'Reports successfully saved!');
        } catch (\Exception $e) {
            return response()->json(['message' => 'There was an error sending the email'], 500);
        }
        return $this->sendResponse($report->toArray(), 'Reports created successfully.');
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);
        if (!$report) {
            return (new ResponseController)->error('Report not found', 404);
        }
        return (new ResponseController)->success('Report retrieved', $report);
    }

    public function update(Request $request, $id)
    {
        $report = Report::find($id);

        if (!$report) {
            return response()->json(['message' => 'report not found'], 404);
        }
        $report->update($request->all());
        return response()->json(['message' => 'Reports Edited successfully!'], 200);
    }

    public function destroy($id)
    {
        $report = Report::find($id);
        if (!$report) {
            return response()->json(['message' => 'report not found'], 404);
        }
        $report->delete();
        return response()->json(['message' => 'Reports Deleted Successfully!'],200);
    }
}
