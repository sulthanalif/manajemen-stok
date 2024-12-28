@extends('components.layouts.app')

@section('title', 'Laporan Closing')

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
                                <select name="month" class="form-control" onchange="location.href = '?{{ http_build_query(request()->except(['month'])) }}&month=' + this.value;">
                                    <option value="" selected disabled>Pilih Bulan</option>
                                    @foreach (range(1, 12) as $m)
                                        <option value="{{ $m }}" {{ (int)($month ?? '') === $m ? 'selected' : '' }}>
                                            {{ DateTime::createFromFormat('!m', $m)->format('F') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mr-2">
                                <select name="year" class="form-control" onchange="location.href = '?{{ http_build_query(request()->except(['year'])) }}&year=' + this.value;">
                                    <option value="" selected disabled>Pilih Tahun</option>
                                    @for ($y = date('Y') - 5; $y <= date('Y'); $y++)
                                        <option value="{{ $y }}" {{ (int)($year ?? '') === $y ? 'selected' : '' }}>
                                            {{ $y }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <a href="{{ route('laporan.closing') }}" class="btn btn-primary ml-2">Reset</a>
                        </div>
                    </form>
                </div>
                    <div class="">
                    <a target="_blank" href="{{ route('laporan.closing', array_merge(request()->query(), ['export1' => 1])) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a>
                    <a target="_blank" href="{{ route('laporan.closing', array_merge(request()->query(), ['export2' => 1])) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
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
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($closings as $r)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $r->code }}</td>
                                    <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d-m-Y') }}</td>
                                    @role('Owner|Purchase|Kepala Toko')
                                    <td>{{ $r->user->name }}</td>
                                    @endrole
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

