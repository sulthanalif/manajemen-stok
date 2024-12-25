

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice - {{ $datas->code }}</title>

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
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
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
        <h1 style="text-align: center">Invoice</h1>
        <p><strong>Nomer Request:</strong> {{ $datas->code }}</p>
        <p><strong>Tanggal Request:</strong> {{ \Carbon\Carbon::parse($datas->tanggal)->format('d F Y') }}</p>
        <p><strong>Chef:</strong> {{ $datas->user->name }}</p>
        <p><strong>Pembayaran:</strong> {{ $datas->is_payment ? 'Paid ('. $datas->method .')' : 'Unpaid' }}</p>
    </div>
    <table class="invoice-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Item</th>
                <th>Vendor</th>
                <th>Harga Satuan</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas->requestItems as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->item->nama }}</td>
                    <td>{{ $item->vendor->nama }}</td>
                    <td>Rp {{ number_format($item->item->vendorItems->first()->harga, 2, ',', '.') }}</td>
                    <td>{{ $item->jumlah }}{{ $item->item->satuan->simbol }}</td>
                    <td>Rp {{ number_format($item->sub_total, 2, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5">Total</th>
                <th>Rp {{ number_format($datas->total_harga, 2, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
</body>
</html>

