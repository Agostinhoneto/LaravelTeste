<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();
        return response()->json($reports);
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
}
