<?php

namespace App\Http\Controllers;

use App\Model\Report;
use Illuminate\Http\Request;
use App\Model\Profile;
use App\Model\ProfileReport;
use Illuminate\Support\Facades\Mail;
use PDF;
use App\Mail\ReportMail;

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
        $report = new Report([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        $report->save();

        $profileIds = new ProfileReport();
        $profileIds->profile_id = $request->input('profile_id');
        $profileIds->report_id = $report->id;
        $profileIds->save();

        session()->flash('success', 'Reports salvo com sucesso!');

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
        session()->flash('success', 'Reports Editado com sucesso!');
        return redirect()->route('reports.index');
    }

    public function destroy($id)
    {
        $report = Report::find($id);
        $report->delete();
        session()->flash('success', 'Reports Excluido com sucesso!');
        return redirect()->route('reports.index');
    }

    public function generatePDF()
    {
        $report = Report::all();

        $data = ['titulo' => 'Reports Profile'];
        $pdf = PDF::loadView('reports.pdf', $data, compact('report'));
        return $pdf->download('teste.pdf');
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
            Mail::send([], [], function ($message) use ($report, $pdf) {
                $message->to('seu-email@example.com')
                    ->subject('Relatório')
                    ->attachData($pdf->output(), 'relatorio.pdf', ['mime' => 'application/pdf'])
                    ->setBody('Relatório em anexo.');
            });
            return response()->json(['message' => 'E-mail enviado com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocorreu um erro ao enviar o e-mail'], 500);
        }
    }
  
}
