<?php

namespace App\Http\Controllers;

use App\Models\Closing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Request as ModelsRequest;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->roles[0]->name == 'Chef') {
            $requests = ModelsRequest::where('user_id', Auth::user()->id)->limit(5)->latest()->get();
            $closings = Closing::where('user_id', Auth::user()->id)->limit(5)->latest()->get();
            $allRequestCount = $requests->count();
            $requestAccCount = $requests->whereNotIn('status', ['Pending', 'Rejected'])->count();
            $requestPendingCount = $requests->whereIn('status', 'Pending')->count();
            $requestRejectedCount = $requests->whereIn('status', 'Rejected')->count();
        } else {
            $closings = Closing::where('status', 'Pending')->limit(5)->latest()->get();
            if (Auth::user()->roles[0]->name == 'Owner') {
                $requests = ModelsRequest::whereIn('status', ['Pending', 'Vendor Sudah Dipilih', 'Approved by Owner'])->limit(5)->latest()->get();
            } elseif (Auth::user()->roles[0]->name == 'Kepala Toko') {
                $requests = ModelsRequest::whereIn('status', ['Pending', 'Sudah Order'])->limit(5)->latest()->get();
            } elseif (Auth::user()->roles[0]->name == 'Purchase') {
                $requests = ModelsRequest::whereIn('status', ['Accepted', 'Paid'])->limit(5)->latest()->get();
            }
            $allRequestCount = $requests->count();
            $requestAccCount = $requests->whereNotIn('status', ['Pending', 'Rejected'])->count();
            $requestPendingCount = $requests->whereIn('status', ['Pending'])->count();
            $requestRejectedCount = $requests->whereIn('status', ['Rejected'])->count();
        }


        $year = $request->get('year', date('Y'));
        $monthlyData = ModelsRequest::selectRaw('MONTH(tanggal) as month, SUM(total_harga) as total_expenditure')
            ->whereYear('tanggal', $year)
            ->groupByRaw('MONTH(tanggal)')
            ->get()
            ->pluck('total_expenditure', 'month')
            ->toArray();

        $chartData = array_fill(0, 12, 0);
        foreach ($monthlyData as $month => $total) {
            $chartData[$month - 1] = $total; // subtract 1 to match the zero-based index
        }

        // $max = !empty($chartData) ? max($chartData) : 0;

        // return response()->json($chartData);

        //barang masuk dan keluar
        $itemTransactions = [
            'masuk' => array_fill(0, 12, 0),
            'keluar' => array_fill(0, 12, 0)
        ];

        $modelRequest = ModelsRequest::with(['requestItems' => function ($q) {
            $q->selectRaw('request_id, SUM(jumlah) as jumlah')
            ->groupBy('request_id');
        }])->whereYear('tanggal', $year)->where('status', 'Success')->get();

        foreach ($modelRequest as $item) {
            $month = date('n', strtotime($item->tanggal)) - 1;
            $itemTransactions['masuk'][$month] += $item->requestItems->sum('jumlah');
        }

        $modelClosing = Closing::with(['closingItems' => function ($q) {
            $q->selectRaw('closing_id, SUM(jumlah_berkurang) as jumlah')
              ->groupBy('closing_id');
        }])->whereYear('tanggal', $year)->where('status', 'Accepted')->get();

        foreach ($modelClosing as $item) {
            $month = date('n', strtotime($item->tanggal)) - 1;
            $itemTransactions['keluar'][$month] += $item->closingItems->sum('jumlah');
        }

        // dd($itemTransactions);

        // dd($itemTransactions);
        return view('dashboard', compact('requests', 'itemTransactions', 'closings', 'allRequestCount', 'requestAccCount', 'requestPendingCount', 'requestRejectedCount', 'year', 'chartData'));
    }
}
