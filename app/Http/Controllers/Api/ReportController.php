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
                
        return $this->sendResponse($report->toArray(), 'Reports created successfully.');
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);

        if (!$report) {
            return (new ResponseController)->error('Report not found', 404);
        }

        return (new ResponseController)->success('Report retrieved', $report);

       // return response()->json($report);
    }

    public function update(Request $request, $id)
    {
        $report = Report::findOrFail($id);
        $report->update($request->all());
        return response()->json($report);
    }

    public function destroy($id)
    {
        $report = Report::findOrFail($id);
        $report->delete();
        return response()->json(null, 204);
    }


    public function sendmail(Request $request)
    {
        dd('aqui');
        /*
        $data["email"] = $request->get("email");
        $data["client_name"] = $request->get("client_name");
        $data["subject"] = $request->get("subject");

        $report = Report::all();
        $data = ['titulo' => 'Reports Profile'];
        $pdf = PDF::loadView('reports.pdf');
        Mail::send('mails.mail', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"], $data["client_name"])
                ->subject($data["subject"])
                ->attachData($pdf->output(), "invoice.pdf");
        });
        return response()->json(compact('this'));
        */
    }
}
