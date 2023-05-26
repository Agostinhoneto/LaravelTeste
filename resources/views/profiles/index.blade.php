<!-- resources/views/profiles/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Profiles</h1>
        @include('components/flash-message')
        <a href="{{ route('profiles.create') }}" class="btn btn-primary mb-3">Create Profile</a>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($profiles as $profile)
                    <tr>
                        <td>{{ $profile->id }}</td>
                        <td>{{ $profile->first_name }}</td>
                        <td>{{ $profile->last_name }}</td>
                        <td>{{ $profile->dob}}</td>
                        <td>{{ $profile->gender }}</td>
                        <td>
                            <a href="{{ route('profiles.show', $profile->id) }}" class="btn btn-success btn-sm">View Profiles</a>
                            <a href="{{ route('profiles.edit', $profile->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this profile?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $profiles->links()}}
    </div>
@endsection
