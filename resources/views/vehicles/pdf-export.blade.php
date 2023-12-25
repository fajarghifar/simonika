<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicles PDF Export</title>
    <style>
        /* Sesuaikan gaya CSS sesuai kebutuhan Anda */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Data Kendaraan</h2>

    <table>
        <thead>
            <tr>
                <th>Nomor STNK</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Kantor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->stnk_number }}</td>
                    <td>{{ $vehicle->brand->name }}</td>
                    <td>{{ $vehicle->model }}</td>
                    <td>{{ $vehicle->office->code }} - {{ $vehicle->office->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
