<?php

namespace App\Http\Controllers;

use App\Models\Closing;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ClosingController extends Controller
{
    public function index()
    {
        $closings = Closing::all();
        return view('closing.index', compact('closings'));
    }

    public function show(Closing $closing)
    {
        return view('closing.show', compact('closing'));
    }

    public function changeStatus(Closing $closing, string $status)
    {


        if ($status == 'Accepted') {
            foreach ($closing->closingItems as $item) {
                if ($item->stok != $item->jumlah) {
                    $item->item->update([
                        'stok' => $item->item->stok - $item->jumlah_berkurang
                    ]);
                }
            }
        }

        $closing->update(['status' => $status]);

        Alert::success('Berhasil', 'Closing Berhasil '. ($status === 'Accepted' ? 'Diterima' : 'Ditolak'));
        return redirect()->route('closing.show', $closing);
    }
}
