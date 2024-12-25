<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Request as ModelsRequest;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::user()->roles[0]->name == 'Chef') {
            $requests = ModelsRequest::where('user_id', Auth::user()->id)->get();
            $allRequestCount = $requests->count();
            $requestAccCount = $requests->whereNotIn('status', ['Pending', 'Rejected'])->count();
            $requestPendingCount = $requests->whereIn('status', 'Pending')->count();
            $requestRejectedCount = $requests->whereIn('status', 'Rejected')->count();
        } else {
            if (Auth::user()->roles[0]->name == 'Owner') {
                $requests = ModelsRequest::whereIn('status', ['Pending', 'Vendor Sudah Dipilih', 'Approved by Owner'])->get();
            } elseif (Auth::user()->roles[0]->name == 'Kepala Toko') {
                $requests = ModelsRequest::whereIn('status', ['Pending', 'Sudah Order'])->get();
            } elseif (Auth::user()->roles[0]->name == 'Purchase') {
                $requests = ModelsRequest::whereIn('status', ['Accepted', 'Paid'])->get();
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

        return view('dashboard', compact('requests', 'allRequestCount', 'requestAccCount', 'requestPendingCount', 'requestRejectedCount', 'year', 'chartData'));
    }
}
