@extends('components.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div>
        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Semua Request</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $allRequestCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-folder fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Approved</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $requestAccCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pending
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $requestPendingCount }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Rejected</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $requestRejectedCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-times fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->

        @role('Owner|Chef|Kepala Toko')
        <div class="row">

            <!-- Area Chart -->
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Status Closing</h6>
                        {{-- <div class="">
                            cek
                            <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable" width="100%" cellspacing="0">
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
                                    @forelse ($closings as $c)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $c->code }}</td>
                                            <td>{{ \Carbon\Carbon::parse($c->tanggal)->format('d-m-Y') }}</td>
                                            @role('Owner|Kepala Toko')
                                            <td>{{ $c->user->name }}</td>
                                            @endrole
                                            <td>
                                                {{ $c->status }}
                                            </td>
                                            <td style="text-align: center">
                                                <a href="{{ route('closing.show', $c->id) }}" class="btn btn-sm btn-primary"
                                                    >
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada Closing</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        @endrole
        <div class="row">

            <!-- Area Chart -->
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Status Request</h6>
                        {{-- <div class="">
                            cek
                            <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Cetak Laporan</a>
                        </div> --}}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable" width="100%" cellspacing="0">
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
                                    @forelse ($requests as $r)
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
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">Belum ada Request</td>
                                            </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="row">
            <div class="col-12">
                <!-- Bar Chart -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Pengeluaran</h6>
                        <form action="" method="GET">
                            <div style="width: 200px">
                                <select name="year" id="year" class="form-control form-control-sm" onchange="this.form.submit()">
                                    @for ($i = 2021; $i <= date('Y'); $i++)
                                        <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="myBarChart"></canvas>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Bar Chart -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Transaksi Item</h6>
                        {{-- <form action="" method="GET">
                            <div style="width: 200px">
                                <select name="year" id="year" class="form-control form-control-sm" onchange="this.form.submit()">
                                    @for ($i = 2021; $i <= date('Y'); $i++)
                                        <option value="{{ $i }}" {{ $i == $year ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </form> --}}
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="myBarChart2"></canvas>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

@push('scripts')
    @include('dashboard-script')
@endpush
