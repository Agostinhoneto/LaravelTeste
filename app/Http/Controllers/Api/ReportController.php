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
        $report = Report::find($id);

        if (!$report) {
            return response()->json(['message' => 'Relatório não encontrado'], 404);
        }

        $report->update($request->all());
        return response()->json($report);
    }

    public function destroy($id)
    {
        $report = Report::find($id);

        if (!$report) {
            return response()->json(['message' => 'Relatório não encontrado'], 404);
        }

        $report->delete();
        return response()->json(['message' => 'Relatório excluído com sucesso']);
    }

    public function sendmail($id)
    {
       
        $report = Report::find($id);
        if (!$report) {
            return response()->json(['message' => 'Relatório não encontrado'], 404);
        }
       
        // Lógica para criar o PDF do relatório
        $data = ['titulo' => 'Reports Profile'];
        $pdf = PDF::loadView('reports.pdf', $data, compact('report'));
        return $pdf->download('teste.pdf');
        // Envio do e-mail
        try {
            Mail::send([], [], function ($message) use ($report) {
                $message->to('enviandoemailteste1@gmail.com')
                    ->subject('Relatório')
                   // ->attachData($pdf->output(), 'reports.pdf', ['mime' => 'application/pdf'])
                    ->setBody('Relatório em anexo.');
            });
            return response()->json(['message' => 'E-mail enviado com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao enviar o e-mail'], 500);
        }
    }
}
