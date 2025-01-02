<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Closing - {{ $datas->code }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .invoice-info {
            margin-bottom: 20px;
        }

        .invoice-info p {
            margin-bottom: 10px;
        }

        .invoice-info p strong {
            display: inline-block;
            width: 150px;
        }

        .invoice-table {
            border: 1px solid #ddd;
        }

        .invoice-table td {
            vertical-align: top;
        }

        .invoice-table tfoot td {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="invoice-info">
        <h1 style="text-align: center">Closing</h1>
        <p><strong>Nomer Closing:</strong> {{ $datas->code }}</p>
        <p><strong>Tanggal Closing:</strong> {{ \Carbon\Carbon::parse($datas->tanggal)->format('d F Y') }}</p>
        <p><strong>Chef:</strong> {{ $datas->user->name }}</p>
        {{-- <p><strong>Pembayaran:</strong> {{ $datas->is_payment ? 'Paid ('. $datas->method .')' : 'Unpaid' }}</p> --}}
    </div>
    <div class="invoice-table">
        {{-- <form> --}}
        <h3 class="m-0 text-primary">Item Harian</h3>
        <div class="mt-3">
            <table id="tableRequest" class="table">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Jumlah Closing</th>
                        <th>Jumlah Berkurang</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas->closingItems as $key => $data)
                        @if ($data->item->type == 'Harian')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->item->nama }}</td>
                                <td class='text-center'>{{ $data->item->kategori->nama }}</td>
                                <td class='text-center'>{{ $data->stok }}</td>
                                <td class='text-center'>{{ $data->jumlah }}</td>
                                <td class='text-center'>{{ $data->jumlah_berkurang }}</td>
                                <td class='text-center'>{{ $data->item->satuan->simbol }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="invoice-table" style="margin-top: 20px">
        {{-- <form> --}}
        <h3 class="m-0 text-primary">Item Lainnya</h3>
        <div class="mt-3">
            <table id="tableRequest" class="table">
                <thead>
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Jumlah Closing</th>
                        <th>Jumlah Berkurang</th>
                        <th>Satuan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($datas->closingItems as $key => $data)
                        @if ($data->item->type == 'Bukan Harian')
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->item->nama }}</td>
                                <td class='text-center'>{{ $data->item->kategori->nama }}</td>
                                <td class='text-center'>{{ $data->stok }}</td>
                                <td class='text-center'>{{ $data->jumlah }}</td>
                                <td class='text-center'>{{ $data->jumlah_berkurang }}</td>
                                <td class='text-center'>{{ $data->item->satuan->simbol }}</td>
                            </tr>
                        @endif

                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Tidak Ada</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
