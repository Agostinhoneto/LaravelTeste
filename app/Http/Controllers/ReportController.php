<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use App\Profile;
use App\ProfileReport;
use PDF;
use Swift_Attachment;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

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
////////////////////////////////////////////////////////////
    public function gerarRelatorio(Request $request)
    {
        // Lógica para gerar o relatório em HTML
        $html = '<h1>Relatório</h1>';
        
        // Gere o PDF usando o Dompdf
        $pdf = PDF::loadHTML($html);
        
        // Salve o PDF em um diretório temporário
        $path = storage_path('files.pdf');
        $pdf->save($path);
        
        // Envie o e-mail com o anexo
        $this->enviarEmail($path);
        
        // Retorne uma resposta adequada ao usuário
        return response()->json(['message' => 'Relatório gerado e enviado por e-mail.']);
    }
    
    public function enviarEmail($attachmentPath)
    {
        // Use a biblioteca de envio de e-mails do Laravel para enviar o e-mail com o anexo
        \Mail::raw('Veja o anexo para o relatório.', function($message) use ($attachmentPath) {
            $message->to('agostneto6@gmail.com')
                    ->subject('Relatório')
                    ->attach($attachmentPath);
        });
        
        // Remova o arquivo temporário após o envio do e-mail
        unlink($attachmentPath);
    }
/////////////////////////////////////////////////////////////

    public function generatePDF()
    {
        $report = Report::all();
        
        $data = ['titulo' => 'Reports Profile'];
        $pdf = PDF::loadView('reports.pdf',$data, compact('report'));
        return $pdf->download('teste.pdf');
    }
   
}
