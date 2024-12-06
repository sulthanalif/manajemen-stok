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
    <h1 style="text-align: center">Invoice</h1>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Item</th>
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
                    <td>Rp {{ number_format($item->vendorItems->harga, 2, ',', '.') }}</td>
                    {{-- <td>{{ $detail->quantity }}</td>
                    <td>Rp {{ number_format($detail->subtotal, 2, ',', '.') }}</td> --}}
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4">Total</th>
                <th>Rp {{ number_format($invoice->total, 2, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>
