<!-- resources/views/reports/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Reports</h1>
        @include('components/flash-message')
        <a href="{{ route('reports.create') }}" class="btn btn-primary mb-3">Create Report</a>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ $report->title }}</td>
                        <td>{{ $report->description }}</td>
                        <td>
                            <a href="{{ route('reports.show', $report->id) }}" class="btn btn-success btn-sm">View Profiles</a>
                            <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this report?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $reports->links()}}
    </div>
@endsection
