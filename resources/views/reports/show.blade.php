<div class="container">
    <h1>Report Details</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Profile ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($report->profiles as $profile)
                <tr>
                    <td>{{ $profile->id }}</td>
                    <td>{{ $profile->name }}</td>
                    <td>{{ $profile->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
