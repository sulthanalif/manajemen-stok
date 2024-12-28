@extends('components.layouts.app')

@section('title', 'Laporan Request')

@section('content')
<div class="row">


    <!-- Area Chart -->
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                <div class="d-flex justify-content-between">
                    <form action="{{ route('laporan.request') }}" method="GET">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="mr-2">
                                <input type="date" name="start" value="{{ $start ?? '' }}" class="form-control">
                            </div>
                            <div class="mr-2">
                                <input type="date" name="end" value="{{ $end ?? '' }}" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Filter</button>
                            <a href="{{ route('laporan.request') }}" class="btn btn-primary ml-2">Reset</a>
                        </div>
                    </form>
                </div>
                    <div class="">
                    <a target="_blank" href="{{ route('laporan.request', array_merge(request()->query(), ['export' => 1])) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a>

                    <a target="_blank" href="{{ route('laporan.request', array_merge(request()->query(), ['exportItem' => 1])) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan Items</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Tanggal</th>
                                @role('Owner|Purchase|Kepala Toko')
                                <th>Chef</th>
                                <th>Pengeluaran</th>
                                @endrole
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($modelsRequest as $r)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $r->code }}</td>
                                    <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d-m-Y') }}</td>
                                    @role('Owner|Purchase|Kepala Toko')
                                    <td>{{ $r->user->name }}</td>
                                    <td>
                                        Rp.{{ number_format($r->total_harga, 0, ',', '.') }}
                                    </td>
                                    @endrole
                                    <td style="text-align: center">
                                        <a href="{{ route('request.show', $r->id) }}" class="btn btn-sm btn-primary"
                                            >
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection

