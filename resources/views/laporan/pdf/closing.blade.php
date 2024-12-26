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

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
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
                <th style="width: 50px">No</th>
                <th style="width: 150px">Tanggal</th>
                <th style="width: 150px">Code</th>
                @role('Owner|Purchase|Kepala Toko')
                    <th>Chef</th>
                @endrole
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('d F Y') }}</td>
                    <td style="text-align: center">{{ $data->code }}</td>
                    @role('Owner|Purchase|Kepala Toko')
                        <td>{{ $r->user->name }}</td>
                    @endrole
                </tr>
            @endforeach
            @role('Owner|Purchase|Kepala Toko')
                <tr>
                <tr>
                    <th colspan="4" style="text-align: center">Total Pengeluaran</th>
                    <td>Rp. {{ number_format(array_sum(array_column($datas->toArray(), 'total_harga')), 0, ',', '.') }}</td>
                </tr>
                </tr>
            @endrole
        </tbody>
    </table>
</body>

</html>
