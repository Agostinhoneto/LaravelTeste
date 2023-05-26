@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Create Report</h1>
        <form action="{{ route('reports.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="profile_id">Profiles:</label>
                <select name="profile_id" id="profile_id" class="form-control">
                    @foreach ($profiles as $profile)
                        <option value="{{ $profile->id }}">{{ $profile->first_name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
