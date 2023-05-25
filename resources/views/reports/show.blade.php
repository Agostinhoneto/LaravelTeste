@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $report->title }}</h1>
        <p>{{ $report->description }}</p>

        <h2>Associated Profiles</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($profiles as $profile)
                    <tr>
                        <td>{{ $profile->first_name }}</td>
                        <td>{{ $profile->last_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
