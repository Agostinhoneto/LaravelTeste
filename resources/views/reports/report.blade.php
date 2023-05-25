<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
    <style>
        /* Add your custom styles for the report here */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            font-size: 24px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <h1>Report</h1>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $data['name'] }}</td>
                <td>{{ $data['email'] }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
