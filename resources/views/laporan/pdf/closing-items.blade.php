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
                <th style="width: 20px">No</th>
                <th style="width: 150px">Nama</th>
                <th style="width: 150px">Kategori</th>
                <th style="width: 150px">Jumlah Berkurang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data['nama'] }}</td>
                    <td>{{ $data['kategori'] }}</td>
                    <td style="text-align: center">{{ $data['jumlah_berkurang'] }}</td>
                </tr>
            @endforeach

            <tr>
                <tr>
                    <th colspan="3" style="text-align: center">Total</th>
                    <td style="text-align: center">{{ array_sum(array_column($datas, 'jumlah_berkurang')) }}</td>
                </tr>
            </tr>

        </tbody>
    </table>
</body>
</html>

