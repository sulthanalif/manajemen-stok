<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kategori;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RequestController extends Controller
{
    public function laporanRequest(Request $request)
    {
        $start = $request->get('start', date('Y-m-d'));
        $end = $request->get('end', date('Y-m-d'));

        $modelsRequest = ModelsRequest::whereBetween('tanggal', [$start, $end])
            ->get();

        if ($request->get('export')) {
            $title = 'Laporan Request ' . \Carbon\Carbon::parse($start)->translatedFormat('d F Y') . ' - ' . \Carbon\Carbon::parse($end)->translatedFormat('d F Y');
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML(view('laporan.pdf.request', ['datas' => $modelsRequest, 'title' => $title]));
            $mpdf->Output();
        }

        return view('laporan.request', compact('modelsRequest', 'start', 'end'));
    }
    public function createRequest()
    {
        return view('request.create');
    }

    public function show(Request $request, ModelsRequest $modelsRequest)
    {
        if ($request->get('export')) {
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML(view('request.pdf.invoice', ['datas' => $modelsRequest]));
            $mpdf->Output();
        }
        return view('request.show', compact('modelsRequest'));
    }

    public function changeStatus(ModelsRequest $modelsRequest, $status)
    {
        $mes = '';
        if ($status == 'A') {
            $modelsRequest->update(['status' => 'Accepted', 'waiting' => 'Menentukan Vendor oleh Purchase...']);
            $mes = 'Diterima';
        } else if ($status == 'B') {
            $modelsRequest->update(['status' => 'Rejected', 'waiting' => null]);
            $mes = 'Ditolak';
        } else if ($status == 'D') {
            $modelsRequest->update(['status' => 'Approved by Owner', 'waiting' => 'Pembayaran....']);
            $mes = 'Diterima';
        } else if ($status == 'C') {
            $modelsRequest->update(['status' => 'Rejected by Owner', 'waiting' => null]);
            $mes = 'Ditolak';
        } else if ($status == 'E') {
            $modelsRequest->update(['status' => 'Sudah Order', 'waiting' => 'Menunggu item tiba...']);
            $mes = 'Dipesan';
        } else if ($status == 'F') {
            $modelsRequest->update(['status' => 'Success', 'waiting' => null]);
            $mes = 'Selesai';

            foreach ($modelsRequest->requestItems as $item) {
                $item->item->update([
                    'stok' => $item->item->stok + $item->jumlah
                ]);
            }
        }

        Alert::success('Berhasil', 'Request ' . $mes);
        return redirect()->route('request.show', $modelsRequest->id);
    }

    public function payment(Request $request, ModelsRequest $modelsRequest)
    {
        $modelsRequest->update([
            'status' => 'Paid',
            'waiting' => 'Order.......',
            'method' => $request->method,
            'is_payment' => 1
        ]);
        Alert::success('Berhasil', 'Pembayaran Berhasil');
        return redirect()->route('request.show', $modelsRequest->id);
    }
}
