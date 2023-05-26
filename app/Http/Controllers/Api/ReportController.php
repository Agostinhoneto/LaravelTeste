<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PDF;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();
        return response()->json($reports, 201);
    }

    public function store(Request $request)
    {
        $report = Report::create($request->all());
        return response()->json($report, 201);
    }

    public function show($id)
    {
        $report = Report::findOrFail($id);
        return response()->json($report);
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
