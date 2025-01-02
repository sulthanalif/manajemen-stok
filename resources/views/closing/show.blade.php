@extends('components.layouts.app')

@section('title', 'Detail Request')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $closing->code }}</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p><strong>Tanggal:</strong>
                                {{ \Carbon\Carbon::parse($closing->tanggal)->format('d M Y') }}</p>
                            <p><strong>Nama Chef:</strong> {{ $closing->user->name }}</p>

                        </div>
                        <div class="col-md-6">
                            <p><strong>Status:</strong> {{ $closing->status }}</p>
                            @if ($closing->status == 'Accepted')
                            <a target="_blank" href="{{ route('closing.show', [$closing->id, 'export' => true]) }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Cetak</a>
                            @endif
                        </div>
                    </div>

                    <div class="responsive">
                        {{-- <form> --}}
                        <h3 class="m-0 text-primary">Item Harian</h3>
                        <div class="mt-3">
                            <table id="tableRequest" class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Jumlah Closing</th>
                                        <th>Jumlah Berkurang</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($closing->closingItems as $key => $data)
                                        @if ($data->item->type == 'Harian')
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->item->nama}}</td>
                                            <td class='text-center'>{{ $data->item->kategori->nama}}</td>
                                            <td class='text-center'>{{ $data->stok }}</td>
                                            <td class='text-center'>{{ $data->jumlah }}</td>
                                            <td class='text-center'>{{ $data->jumlah_berkurang }}</td>
                                            <td class='text-center'>{{ $data->item->satuan->simbol}}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="responsive mt-3">
                        {{-- <form> --}}
                        <h3 class="m-0 text-primary">Item Lainnya</h3>
                        <div class="mt-3">
                            <table id="tableRequest" class="table">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Jumlah Closing</th>
                                        <th>Jumlah Berkurang</th>
                                        <th>Satuan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($closing->closingItems as $key => $data)
                                        @if ($data->item->type == 'Bukan Harian')
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $data->item->nama}}</td>
                                            <td class='text-center'>{{ $data->item->kategori->nama}}</td>
                                            <td class='text-center'>{{ $data->stok }}</td>
                                            <td class='text-center'>{{ $data->jumlah }}</td>
                                            <td class='text-center'>{{ $data->jumlah_berkurang }}</td>
                                            <td class='text-center'>{{ $data->item->satuan->simbol}}</td>
                                        </tr>
                                        @endif

                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak Ada</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="float-right mt-5">
                        <a href="javascript:window.history.back()" class="btn btn-secondary">Kembali</a>
                        @role('Kepala Toko||Owner')
                            {{-- <button type="button" class="btn btn-danger" onclick="reject({{ $closing->id }})">Reject</button> --}}
                            @if ($closing->status == 'Pending')
                                <a href="{{ route('closing.status', [$closing->id, 'status' => 'Rejected']) }}"
                                    class="btn btn-danger">Reject</a>
                                <a href="{{ route('closing.status', [$closing->id, 'status' => 'Accepted']) }}"
                                    class="btn btn-success">Acc</a>
                            @endif
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
