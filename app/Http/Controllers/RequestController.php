<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kategori;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class RequestController extends Controller
{

    public function index()
    {
        if(Auth::user()->roles[0]->name == 'chef') {
            $requests = ModelsRequest::with(['user', 'requestItems.item' => function ($q) {
                $q->with('kategori');
            }])->where('user_id', Auth::user()->id)->get();
        } else {
            $requests = ModelsRequest::with(['user', 'requestItems.item' => function ($q) {
                $q->with('kategori');
            }])->get();
        }

        return view('request.index', compact('requests'));
    }
    public function laporanRequest(Request $request)
    {
        $start = $request->get('start', date('Y-m-d'));
        $end = $request->get('end', date('Y-m-d'));

        if ($start > $end) {
            Alert::error('Error', 'Tanggal awal tidak boleh lebih besar dari tanggal akhir');
            return redirect()->route('laporan.request');
        }

        $modelsRequest = ModelsRequest::whereBetween('tanggal', [$start, $end])
            ->with(['requestItems.item' => function ($q) {
                $q->with('kategori');
            }])
            ->get();

        $dataItems = [];
        foreach ($modelsRequest as $item) {
            foreach ($item->requestItems as $items) {
                $index = array_search($items->item->id, array_column($dataItems, 'id'));
                if ($index === false) {
                    $dataItems[] = [
                        'id' => $items->item->id,
                        'nama' => $items->item->nama,
                        'kategori' => $items->item->kategori->nama,
                        'qty' => $items->jumlah,
                    ];
                } else {
                    $dataItems[$index]['qty'] += $items->jumlah;
                }
            }
        }

        if ($request->get('export')) {
            $title = $start == $end ? 'Laporan Items ' . \Carbon\Carbon::parse($start)->translatedFormat('d F Y') : 'Laporan Items ' . \Carbon\Carbon::parse($start)->translatedFormat('d F Y') . ' - ' . \Carbon\Carbon::parse($end)->translatedFormat('d F Y');
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML(view('laporan.pdf.request', ['datas' => $modelsRequest, 'title' => $title]));
            $mpdf->Output();
        }

        if ($request->get('exportItem')) {
            // return response()->json($dataItems);
            $title = $start == $end ? 'Laporan Items ' . \Carbon\Carbon::parse($start)->translatedFormat('d F Y') : 'Laporan Items ' . \Carbon\Carbon::parse($start)->translatedFormat('d F Y') . ' - ' . \Carbon\Carbon::parse($end)->translatedFormat('d F Y');
            $mpdf = new \Mpdf\Mpdf();
            $mpdf->WriteHTML(view('laporan.pdf.item', ['datas' => $dataItems, 'title' => $title]));
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
        $path = $request->file('image')->store('image-payments', 'public');

        $modelsRequest->update([
            'status' => 'Paid',
            'waiting' => 'Order.......',
            'method' => $request->method,
            'is_payment' => 1,
            'image' => $path
        ]);
        Alert::success('Berhasil', 'Pembayaran Berhasil');
        return redirect()->route('request.show', $modelsRequest->id);
    }
}
