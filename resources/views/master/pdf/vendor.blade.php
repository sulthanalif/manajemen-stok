<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 5px;
        }
        th {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1 align="center">{{ $title }}</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No Tlp</th>
                <th>Alamat</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->nama }}</td>
                    <td>{{ $k->email }}</td>
                    <td>{{ $k->nomor }}</td>
                    <td>{{ $k->alamat }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

