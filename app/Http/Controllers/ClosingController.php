<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\Closing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function laporanClosing(Request $request)
    {
        $month = $request->get('month', date('m'));
        $year = $request->get('year', date('Y'));

        $closings = Closing::query()
            ->whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year);

        if (Auth::user()->roles[0]->name == 'Chef') {
            $closings->where('user_id', Auth::user()->id);
        }

        $closings = $closings->get();

        if ($request->get('export1')) {
            $title = 'Laporan Closing ' . ($request->get('month') ? \Carbon\Carbon::create()->month((int)$request->get('month'))->translatedFormat('F') : '') . ' ' . ($request->get('year') ?? '');
            $mpdf = new Mpdf();
            $mpdf->WriteHTML(view('laporan.pdf.closing', ['datas' => $closings, 'title' => $title]));
            $mpdf->Output();
        }

        return view('laporan.closing', compact('closings', 'month', 'year'));
    }
}
