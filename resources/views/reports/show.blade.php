@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Reports</h2>

        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
               <td>{{ $report->title }}</td>
               <td>{{ $report->description }}</td>     
            </tbody>   
        </table>
    </div>    
        <h2>Associated Profiles</h2>
    <div class="container">     
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
