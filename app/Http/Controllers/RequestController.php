<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Kategori;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class RequestController extends Controller
{
    public function createRequest()
    {


        return view('request.create');
    }

    public function show(ModelsRequest $modelsRequest)
    {
        return view('request.show', compact('modelsRequest'));
    }

    public function changeStatus(ModelsRequest $modelsRequest, $status)
    {
        $mes = '';
        if ($status == 'A') {
            $modelsRequest->update(['status' => 'Accepted', 'waiting' => 'Menentukan Vendor oleh Purchase...']);
            $mes = 'Diterima';
        } else if($status == 'B') {
            $modelsRequest->update(['status' => 'Rejected', 'waiting' => null]);
            $mes = 'Ditolak';
        } else if($status == 'D') {
            $modelsRequest->update(['status' => 'Approved by Owner', 'waiting' => 'Pembayaran....']);
            $mes = 'Diterima';
        } else if($status == 'C') {
            $modelsRequest->update(['status' => 'Rejected by Owner', 'waiting' => null]);
            $mes = 'Ditolak';
        } else if($status == 'E') {
            $modelsRequest->update(['status' => 'Sudah Order', 'waiting' => 'Menunggu item tiba...']);
            $mes = 'Dipesan';
        } else if($status == 'F') {
            $modelsRequest->update(['status' => 'Success', 'waiting' => null]);
            $mes = 'Selesai';
        }

        Alert::success('Berhasil', 'Request '. $mes);
        return redirect()->route('request.show', $modelsRequest->id);
    }

    public function payment(Request $request, ModelsRequest $modelsRequest)
    {
        $modelsRequest->update([
            'status' => 'Paid',
            'waiting' => 'Order.......',
            'bank' => $request->bank,
            'is_payment' => 1
        ]);
        Alert::success('Berhasil', 'Pembayaran Berhasil');
        return redirect()->route('request.show', $modelsRequest->id);
    }
}
