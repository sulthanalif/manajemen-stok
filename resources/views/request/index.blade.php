@extends('components.layouts.app')

@section('title', 'Data Request')

@section('content')
<div class="row">

    <!-- Area Chart -->
    <div class="col-lg-12">
        <div class="card shadow mb-4">
            <div class="card-header d-flex justify-content-between align-items-center py-3">
                {{-- <h6 class="m-0 font-weight-bold text-primary">Status Request</h6> --}}
                <a href="{{ route('request.create') }}" class="btn btn-primary">Request</a>
                {{-- <div class="">
                    cek
                    <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a>
                </div> --}}
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
                                <th>Status</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($requests as $r)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $r->code }}</td>
                                    <td>{{ \Carbon\Carbon::parse($r->tanggal)->format('d-m-Y') }}</td>
                                    @role('Owner|Purchase|Kepala Toko')
                                    <td>{{ $r->user->name }}</td>
                                    @endrole
                                    <td>
                                        {{ $r->status }}
                                    </td>
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
